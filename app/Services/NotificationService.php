<?php

namespace App\Services;

use App\Models\Course;
use App\Models\CourseSubscription;
use App\Services\Sms\SmsProviderFactory;
use App\Services\Sms\SmsProviderInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    protected $sms;

    public function __construct(?SmsProviderInterface $sms = null)
    {
        $this->sms = $sms ?: SmsProviderFactory::make();
    }

    public function sendApprovalNotification(string $phoneNumber): void
    {
        $message = 'تمت الموافقة على عملية الدفع الخاصة بك ويمكنك الآن تحميل الملفات.';
        $this->send($phoneNumber, $message);
    }

    public function sendRejectionNotification(string $phoneNumber): void
    {
        $message = 'تم رفض عملية الدفع. يرجى التواصل مع الدعم أو إعادة رفع إثبات الدفع.';
        $this->send($phoneNumber, $message);
    }

    public function sendSubscriptionApproved(CourseSubscription $subscription): void
    {
        $courseName = optional($subscription->course)->title ?? 'الكورس';
        $endDate = optional($subscription->end_date)->format('Y-m-d') ?? '';

        $message = "Congratulations! Your subscription to {$courseName} has been approved. Your subscription is valid until {$endDate}.";
        $messageAr = "تهانينا! تمت الموافقة على اشتراكك في {$courseName}. اشتراكك ساري حتى {$endDate}.";

        $this->send($subscription->phone_number, $messageAr . ' / ' . $message);
    }

    public function sendSubscriptionRejected(CourseSubscription $subscription): void
    {
        $courseName = optional($subscription->course)->title ?? 'الكورس';

        $message = "Unfortunately, your subscription request for {$courseName} has been rejected. Please contact support for more information.";
        $messageAr = "للأسف تم رفض طلب اشتراكك في {$courseName}. يرجى التواصل مع الدعم لمزيد من المعلومات.";

        $this->send($subscription->phone_number, $messageAr . ' / ' . $message);
    }

    public function sendSubscriptionExpiringSoon(CourseSubscription $subscription, int $daysLeft): void
    {
        $courseName = optional($subscription->course)->title ?? 'الكورس';
        $endDate = optional($subscription->end_date)->format('Y-m-d') ?? '';

        $message = "تذكير: اشتراكك في {$courseName} سينتهي خلال {$daysLeft} يوم(أيام) بتاريخ {$endDate}. يرجى التجديد للاستمرار.";

        $this->send($subscription->phone_number, $message);
    }

    public function sendSubscriptionExpired(CourseSubscription $subscription): void
    {
        $courseName = optional($subscription->course)->title ?? 'الكورس';

        $message = "Your subscription to {$courseName} has expired. Please renew to continue accessing the course.";
        $messageAr = "انتهى اشتراكك في {$courseName}. يرجى التجديد لمواصلة الوصول إلى الكورس.";

        $this->send($subscription->phone_number, $messageAr . ' / ' . $message);
    }

    protected function send(string $phoneNumber, string $message): void
    {
        if (!config('services.sms.enabled', false)) {
            Log::info('Notification skipped (SMS disabled)', [
                'phone' => $phoneNumber,
                'message' => $message,
            ]);
            return;
        }

        try {
            $this->sms->send($phoneNumber, $message);
        } catch (\Throwable $e) {
            Log::error('Failed to send notification', [
                'phone' => $phoneNumber,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
