<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ExportsReports;
use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\SubscriptionPlan;
use App\Support\Reports\Report;
use App\Support\Reports\ReportColumn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionPlansController extends Controller
{
    use ExportsReports;
    use HandlesAdminDataTable;

    public function index()
    {
        $objAdmin = Admin::find(Auth::id());
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return view('auth.admin.subscription_plans.index', [
            'title' => 'خطط الاشتراك',
            'objAdmin' => $objAdmin,
            'courses' => $courses,
        ]);
    }

    public function get(Request $request)
    {
        $query = $this->filteredQuery($request);

        $totalRecords = SubscriptionPlan::count();
        $totalDisplay = (clone $query)->count();

        $columnMap = [
            0 => 'id',
            1 => 'name',
            2 => 'duration_in_months',
            3 => 'price',
            4 => 'is_active',
            5 => 'created_at',
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

        $plans = $query->with('course')->get();
        $csrf = csrf_token();

        $data = $plans->map(function (SubscriptionPlan $plan) use ($csrf) {
            $statusBadge = $plan->is_active
                ? '<span class="badge badge-light-success">نشط</span>'
                : '<span class="badge badge-light-danger">معطّل</span>';

            $toggleLabel = $plan->is_active ? 'تعطيل' : 'تفعيل';
            $toggleClass = $plan->is_active ? 'btn-light-warning' : 'btn-light-success';

            $actions = '<a href="' . route('admin.subscription-plans.edit', $plan) . '" class="btn btn-sm btn-light-primary">تعديل</a> '
                . '<form action="' . route('admin.subscription-plans.toggle', $plan) . '" method="POST" class="d-inline">'
                . '<input type="hidden" name="_token" value="' . $csrf . '">'
                . '<button type="submit" class="btn btn-sm ' . $toggleClass . '">' . $toggleLabel . '</button>'
                . '</form> '
                . '<form action="' . route('admin.subscription-plans.destroy', $plan) . '" method="POST" class="d-inline" onsubmit="return confirm(\'هل أنت متأكد من الحذف؟\')">'
                . '<input type="hidden" name="_token" value="' . $csrf . '">'
                . '<input type="hidden" name="_method" value="DELETE">'
                . '<button type="submit" class="btn btn-sm btn-light-danger">حذف</button>'
                . '</form>';

            return [
                'id' => $plan->id,
                'name' => $plan->name,
                'course_title' => optional($plan->course)->title ?? 'عام (كل الكورسات)',
                'duration' => $plan->duration_label,
                'price' => number_format((float) $plan->price, 2),
                'status_label' => $statusBadge,
                'created_at' => optional($plan->created_at)->format('Y-m-d'),
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
        return $this->exportReport($this->plansReport($request), $request);
    }

    protected function plansReport(Request $request): Report
    {
        $plans = $this->filteredQuery($request)
            ->with('course')
            ->withCount('subscriptions')
            ->latest()
            ->get();

        $courseLabels = Course::pluck('title', 'id')->all();
        $courseLabels['global'] = 'خطط عامة (كل الكورسات)';

        return Report::make('تقرير خطط الاشتراك')
            ->subtitle('خطط الاشتراك المتاحة ومددها وأسعارها')
            ->filters([
                'كلمة البحث' => $this->searchValue($request),
                'الحالة' => $this->filterLabel($request->input('status'), [
                    'active' => 'نشط',
                    'inactive' => 'معطّل',
                ]),
                'الكورس' => $this->filterLabel($request->input('course_id'), $courseLabels),
            ])
            ->summary([
                'إجمالي الخطط' => number_format($plans->count()),
                'خطط نشطة' => number_format($plans->where('is_active', true)->count()),
                'خطط معطّلة' => number_format($plans->where('is_active', false)->count()),
                'إجمالي الاشتراكات' => number_format($plans->sum('subscriptions_count')),
            ])
            ->columns([
                ReportColumn::text('id', '#')->width(6)->align('center'),
                ReportColumn::text('name', 'اسم الخطة')->width(22),
                ReportColumn::text('course.title', 'الكورس')->width(22)->placeholder('عام (كل الكورسات)'),
                ReportColumn::text('duration_label', 'المدة')->width(15),
                ReportColumn::currency('price', 'السعر')->width(13)->totalled(),
                ReportColumn::number('subscriptions_count', 'عدد المشتركين')->width(10)->totalled(),
                ReportColumn::status('is_active', 'الحالة', [
                    '1' => ['نشط', 'success'],
                    '0' => ['معطّل', 'danger'],
                ])->width(9),
                ReportColumn::date('created_at', 'تاريخ الإنشاء')->width(13),
            ])
            ->rows($plans)
            ->landscape()
            ->fileName('subscription-plans')
            ->sheetName('خطط الاشتراك');
    }

    public function create()
    {
        $objAdmin = Admin::find(Auth::id());
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return view('auth.admin.subscription_plans.create', [
            'title' => 'إضافة خطة اشتراك',
            'objAdmin' => $objAdmin,
            'courses' => $courses,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'nullable|exists:courses,id',
            'duration_in_months' => 'required|integer|in:3,6,12',
            'price' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        SubscriptionPlan::create([
            'name' => $data['name'],
            'course_id' => $data['course_id'] ?: null,
            'duration_in_months' => $data['duration_in_months'],
            'price' => $data['price'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.subscription-plans.index')->with('success', 'تم إنشاء خطة الاشتراك بنجاح.');
    }

    public function edit(SubscriptionPlan $subscription_plan)
    {
        $objAdmin = Admin::find(Auth::id());
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return view('auth.admin.subscription_plans.edit', [
            'title' => 'تعديل خطة اشتراك',
            'plan' => $subscription_plan,
            'objAdmin' => $objAdmin,
            'courses' => $courses,
        ]);
    }

    public function update(Request $request, SubscriptionPlan $subscription_plan)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'course_id' => 'nullable|exists:courses,id',
            'duration_in_months' => 'required|integer|in:3,6,12',
            'price' => 'required|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $subscription_plan->update([
            'name' => $data['name'],
            'course_id' => $data['course_id'] ?: null,
            'duration_in_months' => $data['duration_in_months'],
            'price' => $data['price'],
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.subscription-plans.index')->with('success', 'تم تحديث خطة الاشتراك بنجاح.');
    }

    public function toggle(SubscriptionPlan $subscription_plan)
    {
        $subscription_plan->update(['is_active' => !$subscription_plan->is_active]);

        return back()->with('success', 'تم تحديث حالة الخطة.');
    }

    public function destroy(SubscriptionPlan $subscription_plan)
    {
        if ($subscription_plan->subscriptions()->exists()) {
            return back()->with('error', 'لا يمكن حذف خطة مرتبطة بطلبات اشتراك. يمكنك تعطيلها بدلاً من ذلك.');
        }

        $subscription_plan->delete();

        return redirect()->route('admin.subscription-plans.index')->with('success', 'تم حذف الخطة.');
    }

    private function filteredQuery(Request $request)
    {
        $query = SubscriptionPlan::query();

        $status = $request->input('status');
        if ($status === 'active') {
            $query->where('is_active', true);
        } elseif ($status === 'inactive') {
            $query->where('is_active', false);
        }

        $courseId = $request->input('course_id');
        if ($courseId && $courseId !== 'all') {
            if ($courseId === 'global') {
                $query->whereNull('course_id');
            } else {
                $query->where('course_id', $courseId);
            }
        }

        $search = $this->searchValue($request);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%")
                    ->orWhere('price', 'like', "%{$search}%")
                    ->orWhereHas('course', function ($courseQuery) use ($search) {
                        $courseQuery->where('title', 'like', "%{$search}%");
                    });
            });
        }

        return $query;
    }
}
