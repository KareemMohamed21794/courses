<?php

namespace App\Services;

use App\Models\Admin;
use App\Models\CourseSubscription;
use App\Models\Payment;
use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;

class SubscriptionService
{
    protected $notifications;

    public function __construct(NotificationService $notifications)
    {
        $this->notifications = $notifications;
    }

    public function request(array $data): CourseSubscription
    {
        $phone = $data['phone_number'];
        $courseId = (int) $data['course_id'];
        $planId = (int) $data['subscription_plan_id'];

        if (CourseSubscription::hasPendingOrActive($phone, $courseId)) {
            throw new InvalidArgumentException('يوجد بالفعل طلب أو اشتراك نشط لهذا الكورس.');
        }

        $plan = SubscriptionPlan::active()
            ->forCourse($courseId)
            ->where('id', $planId)
            ->firstOrFail();

        return CourseSubscription::create([
            'phone_number' => $phone,
            'name' => $data['name'] ?? null,
            'course_id' => $courseId,
            'subscription_plan_id' => $plan->id,
            'status' => CourseSubscription::STATUS_PENDING,
            'payment_image' => $data['payment_image'] ?? null,
        ]);
    }

    public function approve(CourseSubscription $subscription, Admin $admin, ?Carbon $startDate = null): CourseSubscription
    {
        if ($subscription->status !== CourseSubscription::STATUS_PENDING) {
            throw new InvalidArgumentException('لا يمكن الموافقة على هذا الطلب.');
        }

        if (CourseSubscription::hasActiveAccess($subscription->phone_number, $subscription->course_id)) {
            throw new InvalidArgumentException('لدى المستخدم اشتراك نشط بالفعل لهذا الكورس.');
        }

        $plan = $subscription->plan;
        if (!$plan) {
            throw new InvalidArgumentException('خطة الاشتراك غير موجودة.');
        }

        $start = $startDate ? $startDate->copy()->startOfDay() : Carbon::today();
        $end = $start->copy()->addMonths($plan->duration_in_months)->subDay();

        $subscription->update([
            'status' => CourseSubscription::STATUS_APPROVED,
            'start_date' => $start,
            'end_date' => $end,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);

        $subscription->load('course');
        $this->notifications->sendSubscriptionApproved($subscription);

        return $subscription->fresh(['course', 'plan', 'approver']);
    }

    public function reject(CourseSubscription $subscription, Admin $admin): CourseSubscription
    {
        if ($subscription->status !== CourseSubscription::STATUS_PENDING) {
            throw new InvalidArgumentException('لا يمكن رفض هذا الطلب.');
        }

        $subscription->update([
            'status' => CourseSubscription::STATUS_REJECTED,
            'approved_by' => $admin->id,
            'approved_at' => now(),
        ]);

        $subscription->load('course');
        $this->notifications->sendSubscriptionRejected($subscription);

        return $subscription->fresh(['course', 'plan', 'approver']);
    }

    public function expireDueSubscriptions(): int
    {
        $due = CourseSubscription::with('course')
            ->where('status', CourseSubscription::STATUS_APPROVED)
            ->whereDate('end_date', '<', Carbon::today())
            ->get();

        $count = 0;

        foreach ($due as $subscription) {
            DB::transaction(function () use ($subscription, &$count) {
                $subscription->update([
                    'status' => CourseSubscription::STATUS_EXPIRED,
                    'expired_notified_at' => now(),
                ]);
                $this->notifications->sendSubscriptionExpired($subscription);
                $count++;
            });
        }

        return $count;
    }

    public function sendExpiryReminders(int $daysBefore = 3): int
    {
        $targetDate = Carbon::today()->addDays($daysBefore);

        $subscriptions = CourseSubscription::with('course')
            ->where('status', CourseSubscription::STATUS_APPROVED)
            ->whereDate('end_date', $targetDate)
            ->whereNull('reminder_sent_at')
            ->get();

        $count = 0;

        foreach ($subscriptions as $subscription) {
            $this->notifications->sendSubscriptionExpiringSoon($subscription, $daysBefore);
            $subscription->update(['reminder_sent_at' => now()]);
            $count++;
        }

        return $count;
    }

    public static function hasCourseAccess(string $phoneNumber, int $courseId): bool
    {
        if (CourseSubscription::hasActiveAccess($phoneNumber, $courseId)) {
            return true;
        }

        return Payment::hasApprovedAccess($phoneNumber, $courseId);
    }
}
