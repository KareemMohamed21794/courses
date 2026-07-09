<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

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

        $files = $this->resolveCourseFiles($course);

        if (empty($files)) {
            abort(404, 'لا توجد ملفات للتحميل.');
        }

        if (count($files) === 1) {
            $file = $files[0];

            return response()->download($file['path'], $file['name']);
        }

        $zipPath = $this->createZipArchive($files);

        return response()
            ->download($zipPath, $this->safeFilename($course->title) . '.zip')
            ->deleteFileAfterSend(true);
    }

    private function resolveCourseFiles(Course $course): array
    {
        $files = [];
        $disk = Storage::disk('local');

        if ($course->pdf_file) {
            $path = 'courses/' . $course->pdf_file;

            if ($disk->exists($path)) {
                $files[] = [
                    'path' => $disk->path($path),
                    'name' => $this->safeFilename($course->title) . '.pdf',
                ];
            }
        }

        if ($course->video_file) {
            $path = 'courses/videos/' . $course->video_file;

            if ($disk->exists($path)) {
                $extension = pathinfo($course->video_file, PATHINFO_EXTENSION) ?: 'mp4';

                $files[] = [
                    'path' => $disk->path($path),
                    'name' => $this->safeFilename($course->title) . '.' . $extension,
                ];
            }
        }

        return $files;
    }

    private function createZipArchive(array $files): string
    {
        $zipPath = storage_path('app/temp/' . uniqid('course_', true) . '.zip');

        if (!is_dir(dirname($zipPath))) {
            mkdir(dirname($zipPath), 0755, true);
        }

        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            abort(500, 'تعذر إنشاء ملف التحميل.');
        }

        foreach ($files as $file) {
            $zip->addFile($file['path'], $file['name']);
        }

        $zip->close();

        return $zipPath;
    }

    private function safeFilename(string $title): string
    {
        $filename = trim(preg_replace('/[\/\\\\:*?"<>|]/', '', $title) ?? '');

        return $filename !== '' ? $filename : 'course';
    }
}
