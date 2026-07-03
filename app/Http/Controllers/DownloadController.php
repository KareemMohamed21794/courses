<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Request $request, Course $course)
    {
        if (!$course->is_active) {
            abort(404);
        }

        $verifiedPhone = session('verified_phone');
        $verifiedAt = session('verified_at');

        if (!$verifiedPhone || !$verifiedAt || (now()->timestamp - $verifiedAt) > 3600) {
            return redirect()
                ->route('courses.index')
                ->with('error', 'يرجى التحقق من رقم الهاتف أولاً قبل التحميل.');
        }

        if (!Payment::hasApprovedAccess($verifiedPhone, $course->id)) {
            session()->forget(['verified_phone', 'verified_at']);

            return redirect()
                ->route('courses.index')
                ->with('error', 'لم يتم العثور على دفع معتمد لهذا الكورس. يرجى شراء هذا الكورس أولاً.');
        }

        $path = 'courses/' . $course->pdf_file;

        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'الملف غير موجود.');
        }

        $filename = $course->title . '.pdf';

        return Storage::disk('local')->download($path, $filename);
    }
}
