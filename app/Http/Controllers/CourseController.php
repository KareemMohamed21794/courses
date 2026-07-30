<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\SubscriptionPlan;
use App\Services\SubscriptionService;
use Illuminate\Http\Request;
use InvalidArgumentException;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->with(['subscriptionPlans' => function ($q) {
                $q->active()->orderBy('duration_in_months');
            }])
            ->latest()
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function show(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $plans = SubscriptionPlan::active()
            ->forCourse($course->id)
            ->orderBy('duration_in_months')
            ->get();

        return view('courses.show', compact('course', 'plans'));
    }

    public function verifyPhone(Request $request, Course $course)
    {
        $request->validate([
            'phone_number' => 'required|string|min:7|max:20',
        ]);

        $phone = CourseUser::normalizePhone($request->phone_number);

        if (!SubscriptionService::hasCourseAccess($phone, $course->id)) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على اشتراك أو دفع معتمد لهذا الكورس. يرجى التأكد من الرقم أو تقديم طلب اشتراك.',
            ], 422);
        }

        session([
            'verified_phone' => $phone,
            'verified_at' => now()->timestamp,
        ]);

        return response()->json([
            'success' => true,
            'download_url' => route('courses.download', $course),
            'message' => 'تم التحقق بنجاح. جاري تحميل ملفات الكورس...',
        ]);
    }
}
