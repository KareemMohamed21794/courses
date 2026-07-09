<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::where('is_active', true)
            ->latest()
            ->get();

        return view('courses.index', compact('courses'));
    }

    public function verifyPhone(Request $request, Course $course)
    {
        $request->validate([
            'phone_number' => 'required|string|min:7|max:20',
        ]);

        $phone = CourseUser::normalizePhone($request->phone_number);

        if (!Payment::hasApprovedAccess($phone, $course->id)) {
            return response()->json([
                'success' => false,
                'message' => 'لم يتم العثور على دفع معتمد لهذا الكورس. يرجى التأكد من الرقم أو التوجه إلى صفحة الشراء.',
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
