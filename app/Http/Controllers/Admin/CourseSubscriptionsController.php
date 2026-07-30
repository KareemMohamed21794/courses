<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\ExportsReports;
use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\CourseSubscription;
use App\Services\SubscriptionService;
use App\Support\Reports\Report;
use App\Support\Reports\ReportColumn;
use App\Support\Reports\ReportFormatter;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use InvalidArgumentException;

class CourseSubscriptionsController extends Controller
{
    use ExportsReports;
    use HandlesAdminDataTable;

    protected $subscriptions;

    public function __construct(SubscriptionService $subscriptions)
    {
        $this->subscriptions = $subscriptions;
    }

    public function index()
    {
        $objAdmin = Admin::find(Auth::id());
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return view('auth.admin.subscriptions.index', [
            'title' => 'طلبات الاشتراك',
            'objAdmin' => $objAdmin,
            'courses' => $courses,
        ]);
    }

    public function get(Request $request)
    {
        $query = $this->filteredQuery($request);

        $totalRecords = CourseSubscription::count();
        $totalDisplay = (clone $query)->distinct('course_subscriptions.id')->count('course_subscriptions.id');

        $columnMap = [
            0 => 'id',
            2 => 'phone_number',
            3 => 'name',
            5 => 'status',
            6 => 'start_date',
            7 => 'end_date',
            8 => 'created_at',
        ];

        $columnIndex = (int) $request->input('order.0.column', 0);
        $dir = $request->input('order.0.dir', 'desc') === 'asc' ? 'asc' : 'desc';
        $orderColumn = $columnMap[$columnIndex] ?? 'id';

        if ($orderColumn === 'id' || in_array($orderColumn, ['phone_number', 'name', 'status', 'start_date', 'end_date', 'created_at'], true)) {
            $query->orderBy('course_subscriptions.' . $orderColumn, $dir);
        } else {
            $query->orderBy('course_subscriptions.id', $dir);
        }

        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        if ($length !== -1 && $length > 0) {
            $query->skip($start)->take($length);
        }

        $items = $query->with(['course', 'plan', 'approver'])->get();
        $csrf = csrf_token();

        $data = $items->map(function (CourseSubscription $item) use ($csrf) {
            $statusBadge = $this->statusBadge($item);

            $imageHtml = '-';
            if ($item->payment_image) {
                $imageHtml = '<a href="' . e($item->payment_image_url) . '" target="_blank">'
                    . '<img src="' . e($item->payment_image_url) . '" width="60" height="40" style="object-fit:cover;border-radius:6px;">'
                    . '</a>';
            }

            $actions = '';
            if ($item->status === CourseSubscription::STATUS_PENDING) {
                $actions .= '<button type="button" class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#approveModal"'
                    . ' data-action="' . route('admin.subscriptions.approve', $item) . '">موافقة</button>';
                $actions .= '<form action="' . route('admin.subscriptions.reject', $item) . '" method="POST" class="d-inline">'
                    . '<input type="hidden" name="_token" value="' . $csrf . '">'
                    . '<button type="submit" class="btn btn-sm btn-warning">رفض</button>'
                    . '</form> ';
            }

            $actions .= '<form action="' . route('admin.subscriptions.destroy', $item) . '" method="POST" class="d-inline" onsubmit="return confirm(\'هل أنت متأكد من الحذف؟\')">'
                . '<input type="hidden" name="_token" value="' . $csrf . '">'
                . '<input type="hidden" name="_method" value="DELETE">'
                . '<button type="submit" class="btn btn-sm btn-light-danger">حذف</button>'
                . '</form>';

            return [
                'id' => $item->id,
                'course_title' => optional($item->course)->title ?? '-',
                'phone_number' => $item->phone_number,
                'name' => $item->name ?? '-',
                'plan_name' => optional($item->plan)->name ?? '-',
                'payment_image' => $imageHtml,
                'status_label' => $statusBadge,
                'status' => $item->status_label,
                'start_date' => optional($item->start_date)->format('Y-m-d') ?? '-',
                'end_date' => optional($item->end_date)->format('Y-m-d') ?? '-',
                'remaining_days' => $item->remaining_days !== null ? $item->remaining_days : '-',
                'created_at' => optional($item->created_at)->format('Y-m-d H:i'),
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
        return $this->exportReport($this->subscriptionsReport($request), $request);
    }

    protected function subscriptionsReport(Request $request): Report
    {
        $subscriptions = $this->filteredQuery($request)
            ->with(['course', 'plan', 'approver'])
            ->latest()
            ->get();

        $approved = $subscriptions->where('status', CourseSubscription::STATUS_APPROVED);

        return Report::make('تقرير طلبات الاشتراك')
            ->subtitle('اشتراكات الكورسات مع خطط الاشتراك وتواريخ السريان')
            ->filters([
                'كلمة البحث' => $this->searchValue($request),
                'الحالة' => $this->filterLabel($request->input('status'), [
                    CourseSubscription::STATUS_PENDING => 'قيد المراجعة',
                    CourseSubscription::STATUS_APPROVED => 'موافق عليه',
                    CourseSubscription::STATUS_REJECTED => 'مرفوض',
                    CourseSubscription::STATUS_EXPIRED => 'منتهي',
                ]),
                'الكورس' => $this->filterLabel(
                    $request->input('course_id'),
                    Course::pluck('title', 'id')->all()
                ),
            ])
            ->summary([
                'إجمالي الطلبات' => number_format($subscriptions->count()),
                'اشتراكات سارية' => number_format($subscriptions->filter(function (CourseSubscription $item) {
                    return $item->isActiveAccess();
                })->count()),
                'قيد المراجعة' => number_format($subscriptions->where('status', CourseSubscription::STATUS_PENDING)->count()),
                'منتهية' => number_format($subscriptions->where('status', CourseSubscription::STATUS_EXPIRED)->count()),
                'إيراد الاشتراكات المعتمدة' => ReportFormatter::currency(
                    (float) $approved->sum(function (CourseSubscription $item) {
                        return optional($item->plan)->price ?? 0;
                    })
                ),
            ])
            ->columns([
                ReportColumn::text('id', '#')->width(4)->align('center'),
                ReportColumn::text('course.title', 'الكورس')->width(20),
                ReportColumn::text('name', 'المشترك')->width(15),
                ReportColumn::text('phone_number', 'رقم الهاتف')->width(11)->ltr()->align('center'),
                ReportColumn::text('plan.name', 'خطة الاشتراك')->width(13),
                ReportColumn::currency('plan.price', 'قيمة الخطة')->width(11)->totalled(),
                ReportColumn::status('status', 'الحالة', [
                    CourseSubscription::STATUS_PENDING => ['قيد المراجعة', 'warning'],
                    CourseSubscription::STATUS_APPROVED => ['موافق عليه', 'success'],
                    CourseSubscription::STATUS_REJECTED => ['مرفوض', 'danger'],
                    CourseSubscription::STATUS_EXPIRED => ['منتهي', 'neutral'],
                ])->width(9),
                ReportColumn::date('start_date', 'بداية الاشتراك')->width(9),
                ReportColumn::date('end_date', 'نهاية الاشتراك')->width(9),
                ReportColumn::number('remaining_days', 'الأيام المتبقية')->width(8)->align('center'),
                ReportColumn::datetime('created_at', 'تاريخ الطلب')->width(12),
            ])
            ->rows($subscriptions)
            ->landscape()
            ->fileName('subscriptions')
            ->sheetName('طلبات الاشتراك');
    }

    public function approve(Request $request, CourseSubscription $subscription)
    {
        $request->validate([
            'start_date' => 'nullable|date',
        ]);

        try {
            $admin = Admin::findOrFail(Auth::id());
            $startDate = $request->filled('start_date')
                ? Carbon::parse($request->input('start_date'))
                : null;

            $this->subscriptions->approve($subscription, $admin, $startDate);
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'تمت الموافقة على الاشتراك وتم حساب تاريخ الانتهاء تلقائياً.');
    }

    public function reject(CourseSubscription $subscription)
    {
        try {
            $admin = Admin::findOrFail(Auth::id());
            $this->subscriptions->reject($subscription, $admin);
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'تم رفض طلب الاشتراك.');
    }

    public function destroy(CourseSubscription $subscription)
    {
        $subscription->delete();

        return back()->with('success', 'تم حذف طلب الاشتراك.');
    }

    private function filteredQuery(Request $request)
    {
        $query = CourseSubscription::query();

        $status = $request->input('status');
        if ($status && $status !== 'all') {
            $query->where('course_subscriptions.status', $status);
        }

        $courseId = $request->input('course_id');
        if ($courseId && $courseId !== 'all') {
            $query->where('course_subscriptions.course_id', $courseId);
        }

        $search = $this->searchValue($request);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('course_subscriptions.phone_number', 'like', "%{$search}%")
                    ->orWhere('course_subscriptions.name', 'like', "%{$search}%")
                    ->orWhere('course_subscriptions.id', 'like', "%{$search}%")
                    ->orWhere('course_subscriptions.status', 'like', "%{$search}%")
                    ->orWhereHas('course', function ($courseQuery) use ($search) {
                        $courseQuery->where('title', 'like', "%{$search}%");
                    })
                    ->orWhereHas('plan', function ($planQuery) use ($search) {
                        $planQuery->where('name', 'like', "%{$search}%");
                    });

                if (mb_stripos($search, 'قيد') !== false) {
                    $q->orWhere('course_subscriptions.status', 'pending');
                }
                if (mb_stripos($search, 'موافق') !== false) {
                    $q->orWhere('course_subscriptions.status', 'approved');
                }
                if (mb_stripos($search, 'مرفوض') !== false) {
                    $q->orWhere('course_subscriptions.status', 'rejected');
                }
                if (mb_stripos($search, 'منتهي') !== false) {
                    $q->orWhere('course_subscriptions.status', 'expired');
                }
            });
        }

        return $query;
    }

    private function statusBadge(CourseSubscription $item): string
    {
        $map = [
            'pending' => 'badge-light-warning',
            'approved' => 'badge-light-success',
            'rejected' => 'badge-light-danger',
            'expired' => 'badge-light-dark',
        ];

        $class = $map[$item->status] ?? 'badge-light';

        return '<span class="badge ' . $class . '">' . e($item->status_label) . '</span>';
    }
}
