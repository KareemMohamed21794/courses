<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PDF;

class CoursesController extends Controller
{
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

    public function exportPdf(Request $request)
    {
        $courses = $this->filteredCoursesQuery($request)->latest()->get();

        $pdf = PDF::loadView('auth.admin.courses.export-pdf', [
            'title' => 'تقرير الكورسات',
            'courses' => $courses,
            'filters' => [
                'search' => $this->searchValue($request),
                'status' => $request->input('status', 'all'),
            ],
        ])->setPaper('a4', 'landscape');

        return $pdf->download('courses-' . date('Y-m-d-His') . '.pdf');
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf_file' => 'required|file|mimes:pdf|max:20480',
        ]);

        $pdfName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
        $request->file('pdf_file')->storeAs('courses', $pdfName, 'local');

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        Course::create([
            'title' => $request->title,
            'description' => $request->description,
            'thumbnail' => $thumbnailPath,
            'pdf_file' => $pdfName,
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
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'pdf_file' => 'nullable|file|mimes:pdf|max:20480',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('pdf_file')) {
            Storage::disk('local')->delete('courses/' . $course->pdf_file);
            $pdfName = time() . '_' . $request->file('pdf_file')->getClientOriginalName();
            $request->file('pdf_file')->storeAs('courses', $pdfName, 'local');
            $data['pdf_file'] = $pdfName;
        }

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('courses/thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'تم تحديث الكورس بنجاح.');
    }

    public function destroy(Course $course)
    {
        Storage::disk('local')->delete('courses/' . $course->pdf_file);
        if ($course->thumbnail) {
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->delete();

        return redirect()->route('admin.courses.index')->with('success', 'تم حذف الكورس بنجاح.');
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
