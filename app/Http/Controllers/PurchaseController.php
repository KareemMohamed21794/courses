<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PurchaseController extends Controller
{
    public function create(Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        return view('courses.purchase', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $request->validate([
            'phone_number' => 'required|string|min:7|max:20',
            'name' => 'nullable|string|max:255',
            'payment_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ], [
            'phone_number.required' => 'رقم الهاتف مطلوب.',
            'payment_image.required' => 'يرجى رفع صورة إثبات الدفع.',
            'payment_image.image' => 'يجب أن يكون الملف صورة.',
            'payment_image.max' => 'حجم الصورة يجب ألا يتجاوز 5 ميجابايت.',
        ]);

        $phone = CourseUser::normalizePhone($request->phone_number);

        $imagePath = $request->file('payment_image')->store('payments', 'public');

        Payment::create([
            'course_id' => $course->id,
            'phone_number' => $phone,
            'name' => $request->name,
            'payment_image' => $imagePath,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('courses.index')
            ->with('success', 'تم إرسال طلب الشراء بنجاح. سيتم مراجعته من قبل الإدارة.');
    }
}
