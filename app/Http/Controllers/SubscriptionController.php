<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\SubscriptionPlan;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class SubscriptionController extends Controller
{
    protected $subscriptions;

    public function __construct(SubscriptionService $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function create(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $plans = SubscriptionPlan::active()
            ->forCourse($course->id)
            ->orderBy('duration_in_months')
            ->get();

        if ($plans->isEmpty()) {
            return redirect()
                ->route('courses.show', $course)
                ->with('error', 'لا توجد خطط اشتراك متاحة لهذا الكورس حالياً.');
        }

        return view('courses.subscribe', compact('course', 'plans'));
    }

    public function store(Request $request, Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $request->validate([
            'phone_number' => 'required|string|min:7|max:20',
            'name' => 'nullable|string|max:255',
            'subscription_plan_id' => 'required|exists:subscription_plans,id',
            'payment_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'phone_number.required' => 'رقم الهاتف مطلوب.',
            'subscription_plan_id.required' => 'يرجى اختيار خطة الاشتراك.',
            'payment_image.image' => 'يجب أن يكون الملف صورة.',
            'payment_image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت.',
        ]);

        $phone = CourseUser::normalizePhone($request->phone_number);
        $imagePath = null;

        if ($request->hasFile('payment_image')) {
            $imagePath = $request->file('payment_image')->store('subscriptions', 'public');
        }

        try {
            $this->subscriptions->request([
                'phone_number' => $phone,
                'name' => $request->name,
                'course_id' => $course->id,
                'subscription_plan_id' => $request->subscription_plan_id,
                'payment_image' => $imagePath,
            ]);
        } catch (InvalidArgumentException $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }

        return redirect()
            ->route('subscriptions.dashboard')
            ->with('success', 'تم إرسال طلب الاشتراك بنجاح. سيتم مراجعته من قبل الإدارة.')
            ->with('lookup_phone', $phone);
    }

    public function dashboard(Request $request)
    {
        $phone = null;
        $active = collect();
        $history = collect();

        if ($request->filled('phone_number') || session('lookup_phone')) {
            $raw = $request->input('phone_number', session('lookup_phone'));
            $phone = CourseUser::normalizePhone($raw);

            $all = \App\Models\CourseSubscription::with(['course', 'plan'])
                ->where('phone_number', $phone)
                ->latest()
                ->get();

            $active = $all->filter(function ($sub) {
                return $sub->isActiveAccess() || $sub->status === 'pending';
            })->values();

            $history = $all;
        }

        return view('courses.subscriptions', compact('phone', 'active', 'history'));
    }
}
