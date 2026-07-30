<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ExportsReports;
use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Support\Reports\Report;
use App\Support\Reports\ReportColumn;
use App\Support\Reports\ReportFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CoursesController extends Controller
{
    use ExportsReports;
    use HandlesAdminDataTable;

    public function index()
    {
        $objAdmin = Admin::find(Auth::id());

        return view('auth.admin.courses.index', [
            'title' => 'إدارة الكورسات',
            'objAdmin' => $objAdmin,
        ]);
    }

    public function get(Request $request)
    {
        $query = $this->filteredCoursesQuery($request);

        $totalRecords = Course::count();
        $totalDisplay = (clone $query)->count();

        $columnMap = [
            0 => 'id',
            2 => 'title',
            3 => 'is_active',
            4 => 'created_at',
        ];

        $columnIndex = (int) $request->input('order.0.column', 0);
        $dir = $request->input('order.0.dir', 'desc') === 'asc' ? 'asc' : 'desc';
        $orderColumn = $columnMap[$columnIndex] ?? 'id';
        $query->orderBy($orderColumn, $dir);

        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        if ($length !== -1 && $length > 0) {
            $query->skip($start)->take($length);
        }

        $courses = $query->get();
        $csrf = csrf_token();

        $data = $courses->map(function (Course $course) use ($csrf) {
            $statusBadge = $course->is_active
                ? '<span class="badge badge-light-success">نشط</span>'
                : '<span class="badge badge-light-danger">غير نشط</span>';

            $thumbnailHtml = '<img src="' . e($course->thumbnail_url) . '" alt="" width="60" height="40" style="object-fit:cover;border-radius:6px;">';

            $actions = '<a href="' . route('admin.courses.edit', $course) . '" class="btn btn-sm btn-light-primary">تعديل</a> '
                . '<form action="' . route('admin.courses.destroy', $course) . '" method="POST" class="d-inline" onsubmit="return confirm(\'هل أنت متأكد من الحذف؟\')">'
                . '<input type="hidden" name="_token" value="' . $csrf . '">'
                . '<input type="hidden" name="_method" value="DELETE">'
                . '<button type="submit" class="btn btn-sm btn-light-danger">حذف</button>'
                . '</form>';

            return [
                'id' => $course->id,
                'thumbnail' => $thumbnailHtml,
                'title' => $course->title,
                'instructor' => $course->instructor ?? '-',
                'status_label' => $statusBadge,
                'status' => $course->is_active ? 'نشط' : 'غير نشط',
                'created_at' => $course->created_at->format('Y-m-d'),
                'actions' => $actions,
            ];
        })->values();

        return response()->json([
            'draw' => (int) $request->input('draw', 0),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $totalDisplay,
            'data' => $data,
        ]);
    }

    public function export(Request $request)
    {
        return $this->exportReport($this->coursesReport($request), $request);
    }

    protected function coursesReport(Request $request): Report
    {
        $courses = $this->filteredCoursesQuery($request)
            ->withCount('subscriptionPlans')
            ->latest()
            ->get();

        return Report::make('تقرير الكورسات')
            ->subtitle('قائمة الكورسات المسجلة في المنصة مع حالة النشر والسعر')
            ->filters([
                'كلمة البحث' => $this->searchValue($request),
                'الحالة' => $this->filterLabel($request->input('status'), [
                    'active' => 'نشط',
                    'inactive' => 'غير نشط',
                ]),
            ])
            ->summary([
                'إجمالي الكورسات' => number_format($courses->count()),
                'كورسات نشطة' => number_format($courses->where('is_active', true)->count()),
                'كورسات غير نشطة' => number_format($courses->where('is_active', false)->count()),
                'متوسط السعر' => ReportFormatter::currency((float) ($courses->avg('price') ?: 0)),
            ])
            ->columns([
                ReportColumn::text('id', '#')->width(5)->align('center'),
                ReportColumn::text('title', 'عنوان الكورس')->width(30),
                ReportColumn::text('instructor', 'المدرب')->width(18),
                ReportColumn::currency('price', 'السعر')->width(13)->totalled(),
                ReportColumn::number('subscription_plans_count', 'عدد الخطط')->width(9),
                ReportColumn::status('is_active', 'الحالة', [
                    '1' => ['نشط', 'success'],
                    '0' => ['غير نشط', 'danger'],
                ])->width(10),
                ReportColumn::date('created_at', 'تاريخ الإضافة')->width(15),
            ])
            ->rows($courses)
            ->landscape()
            ->fileName('courses')
            ->sheetName('الكورسات');
    }

    public function create()
    {
        $objAdmin = Admin::find(Auth::id());

        return view('auth.admin.courses.create', [
            'title' => 'إضافة كورس',
            'objAdmin' => $objAdmin,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'intro_video_url' => 'nullable|url|max:500',
            'intro_video_file' => 'nullable|file|mimes:mp4,webm,mov,avi|max:512000',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,avi|max:512000',
        ]);

        if (!$request->hasFile('pdf_file') && !$request->hasFile('video_file')) {
            return back()
                ->withInput()
                ->withErrors(['pdf_file' => 'يجب رفع ملف PDF أو فيديو على الأقل.']);
        }

        $pdfName = null;
        if ($request->hasFile('pdf_file')) {
            $pdfName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('courses', $pdfName, 'local');
        }

        $videoName = null;
        if ($request->hasFile('video_file')) {
            $videoName = time() . '_' . $request->file('video_file')->getClientOriginalName();
            $request->file('video_file')->storeAs('courses/videos', $videoName, 'local');
        }

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        [$introVideo, $introVideoType] = $this->resolveIntroVideo($request);

        $gallery = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('courses/gallery', 'public');
            }
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'price' => $request->price,
            'thumbnail' => $thumbnailPath,
            'intro_video' => $introVideo,
            'intro_video_type' => $introVideoType,
            'gallery_images' => $gallery ?: null,
            'pdf_file' => $pdfName,
            'video_file' => $videoName,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.courses.index')->with('success', 'تم إضافة الكورس بنجاح.');
    }

    public function edit(Course $course)
    {
        $objAdmin = Admin::find(Auth::id());

        return view('auth.admin.courses.edit', [
            'title' => 'تعديل كورس',
            'course' => $course,
            'objAdmin' => $objAdmin,
        ]);
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'instructor' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'intro_video_url' => 'nullable|url|max:500',
            'intro_video_file' => 'nullable|file|mimes:mp4,webm,mov,avi|max:512000',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
            'video_file' => 'nullable|file|mimes:mp4,webm,mov,avi|max:512000',
            'remove_intro_video' => 'nullable|boolean',
            'remove_gallery' => 'nullable|boolean',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'instructor' => $request->instructor,
            'price' => $request->price,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('pdf_file')) {
            if ($course->pdf_file) {
                Storage::disk('local')->delete('courses/' . $course->pdf_file);
            }
            $pdfName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('courses', $pdfName, 'local');
            $data['pdf_file'] = $pdfName;
        }

        if ($request->hasFile('video_file')) {
            if ($course->video_file) {
                Storage::disk('local')->delete('courses/videos/' . $course->video_file);
            }
            $videoName = time() . '_' . $request->file('video_file')->getClientOriginalName();
            $request->file('video_file')->storeAs('courses/videos', $videoName, 'local');
            $data['video_file'] = $videoName;
        }

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        if ($request->boolean('remove_intro_video')) {
            $this->deleteIntroVideoFile($course);
            $data['intro_video'] = null;
            $data['intro_video_type'] = null;
        } elseif ($request->filled('intro_video_url') || $request->hasFile('intro_video_file')) {
            $this->deleteIntroVideoFile($course);
            [$introVideo, $introVideoType] = $this->resolveIntroVideo($request);
            $data['intro_video'] = $introVideo;
            $data['intro_video_type'] = $introVideoType;
        }

        if ($request->boolean('remove_gallery')) {
            $this->deleteGalleryImages($course);
            $data['gallery_images'] = null;
        } elseif ($request->hasFile('gallery_images')) {
            $gallery = $course->gallery_images ?? [];
            foreach ($request->file('gallery_images') as $image) {
                $gallery[] = $image->store('courses/gallery', 'public');
            }
            $data['gallery_images'] = $gallery;
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الكورس بنجاح.');
    }

    public function destroy(Course $course)
    {
        if ($course->pdf_file) {
            Storage::disk('local')->delete('courses/' . $course->pdf_file);
        }
        if ($course->video_file) {
            Storage::disk('local')->delete('courses/videos/' . $course->video_file);
        }
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }
        $this->deleteIntroVideoFile($course);
        $this->deleteGalleryImages($course);

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'تم حذف الكورس بنجاح.');
    }

    private function resolveIntroVideo(Request $request): array
    {
        if ($request->hasFile('intro_video_file')) {
            $path = $request->file('intro_video_file')->store('courses/intro', 'public');

            return [$path, 'file'];
        }

        if ($request->filled('intro_video_url')) {
            return [$request->input('intro_video_url'), 'url'];
        }

        return [null, null];
    }

    private function deleteIntroVideoFile(Course $course): void
    {
        if ($course->intro_video_type === 'file' && $course->intro_video) {
            Storage::disk('public')->delete($course->intro_video);
        }
    }

    private function deleteGalleryImages(Course $course): void
    {
        foreach ($course->gallery_images ?? [] as $path) {
            Storage::disk('public')->delete($path);
        }
    }

    private function filteredCoursesQuery(Request $request)
    {
        $query = Course::query();

        $status = $request->input('status');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $search = $this->searchValue($request);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('instructor', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");

                if (mb_stripos($search, 'نشط') !== false && mb_stripos($search, 'غير') === false) {
                    $q->orWhere('is_active', true);
                }
                if (mb_stripos($search, 'غير نشط') !== false) {
                    $q->orWhere('is_active', false);
                }
            });
        }

        return $query;
    }
}
