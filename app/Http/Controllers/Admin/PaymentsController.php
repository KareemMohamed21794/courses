<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesAdminDataTable;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Course;
use App\Models\Payment;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;

class PaymentsController extends Controller
{
    use HandlesAdminDataTable;

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function index()
    {
        $objAdmin = Admin::find(Auth::id());
        $courses = Course::orderBy('title')->get(['id', 'title']);

        return view('auth.admin.payments.index', [
            'title' => 'طلبات الشراء',
            'objAdmin' => $objAdmin,
            'courses' => $courses,
        ]);
    }

    public function get(Request $request)
    {
        $query = $this->filteredPaymentsQuery($request);

        $totalRecords = Payment::count();
        $totalDisplay = (clone $query)->distinct('payments.id')->count('payments.id');

        $columnMap = [
            0 => 'id',
            1 => 'course_title',
            2 => 'phone_number',
            3 => 'name',
            5 => 'status',
            6 => 'created_at',
        ];

        $columnIndex = (int) $request->input('order.0.column', 0);
        $dir = $request->input('order.0.dir', 'desc') === 'asc' ? 'asc' : 'desc';
        $orderColumn = $columnMap[$columnIndex] ?? 'id';

        if ($orderColumn === 'course_title') {
            $query->leftJoin('courses', 'payments.course_id', '=', 'courses.id')
                ->orderBy('courses.title', $dir)
                ->select('payments.*');
        } else {
            $query->orderBy('payments.' . $orderColumn, $dir);
        }

        $start = (int) $request->input('start', 0);
        $length = (int) $request->input('length', 10);
        if ($length !== -1 && $length > 0) {
            $query->skip($start)->take($length);
        }

        $payments = $query->with('course')->get();

        $csrf = csrf_token();
        $data = $payments->map(function (Payment $payment) use ($csrf) {
            $statusBadge = $this->statusBadge($payment);
            $imageHtml = '<a href="' . e($payment->payment_image_url) . '" target="_blank">'
                . '<img src="' . e($payment->payment_image_url) . '" width="60" height="40" style="object-fit:cover;border-radius:6px;">'
                . '</a>';

            $actions = '';
            if ($payment->status === 'pending') {
                $actions .= '<form action="' . route('admin.payments.approve', $payment) . '" method="POST" class="d-inline">'
                    . '<input type="hidden" name="_token" value="' . $csrf . '">'
                    . '<button type="submit" class="btn btn-sm btn-success">Approve</button>'
                    . '</form> ';
                $actions .= '<form action="' . route('admin.payments.reject', $payment) . '" method="POST" class="d-inline">'
                    . '<input type="hidden" name="_token" value="' . $csrf . '">'
                    . '<button type="submit" class="btn btn-sm btn-warning">Reject</button>'
                    . '</form> ';
            }
            $actions .= '<form action="' . route('admin.payments.destroy', $payment) . '" method="POST" class="d-inline" onsubmit="return confirm(\'هل أنت متأكد من الحذف؟\')">'
                . '<input type="hidden" name="_token" value="' . $csrf . '">'
                . '<input type="hidden" name="_method" value="DELETE">'
                . '<button type="submit" class="btn btn-sm btn-light-danger">Delete</button>'
                . '</form>';

            return [
                'id' => $payment->id,
                'course_title' => optional($payment->course)->title ?? '-',
                'phone_number' => $payment->phone_number,
                'name' => $payment->name ?? '-',
                'payment_image' => $imageHtml,
                'status_label' => $statusBadge,
                'status' => $payment->status_label,
                'created_at' => $payment->created_at->format('Y-m-d H:i'),
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
        $payments = $this->filteredPaymentsQuery($request)
            ->with('course')
            ->latest()
            ->get();

        $filters = [
            'search' => $this->searchValue($request),
            'status' => $request->input('status', 'all'),
            'course_id' => $request->input('course_id', 'all'),
        ];

        $pdf = PDF::loadView('auth.admin.payments.export-pdf', [
            'title' => 'تقرير طلبات الشراء',
            'payments' => $payments,
            'filters' => $filters,
            'courses' => Course::pluck('title', 'id'),
        ])->setPaper('a4', 'landscape');

        return $pdf->download('payments-' . date('Y-m-d-His') . '.pdf');
    }

    public function approve(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'لا يمكن الموافقة على هذا الطلب.');
        }

        $payment->update(['status' => 'approved']);

        $this->notificationService->sendApprovalNotification($payment->phone_number);

        return back()->with('success', 'تمت الموافقة على الطلب وتفعيل الوصول لهذا الكورس.');
    }

    public function reject(Payment $payment)
    {
        if ($payment->status !== 'pending') {
            return back()->with('error', 'لا يمكن رفض هذا الطلب.');
        }

        $payment->update(['status' => 'rejected']);

        $this->notificationService->sendRejectionNotification($payment->phone_number);

        return back()->with('success', 'تم رفض الطلب.');
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return back()->with('success', 'تم حذف الطلب.');
    }

    private function filteredPaymentsQuery(Request $request)
    {
        $query = Payment::query();

        $status = $request->input('status');
        if ($status && $status !== 'all') {
            $query->where('payments.status', $status);
        }

        $courseId = $request->input('course_id');
        if ($courseId && $courseId !== 'all') {
            $query->where('payments.course_id', $courseId);
        }

        $search = $this->searchValue($request);
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('payments.phone_number', 'like', "%{$search}%")
                    ->orWhere('payments.name', 'like', "%{$search}%")
                    ->orWhere('payments.id', 'like', "%{$search}%")
                    ->orWhere('payments.status', 'like', "%{$search}%")
                    ->orWhereHas('course', function ($courseQuery) use ($search) {
                        $courseQuery->where('title', 'like', "%{$search}%");
                    });

                if (mb_stripos($search, 'قيد') !== false) {
                    $q->orWhere('payments.status', 'pending');
                }
                if (mb_stripos($search, 'موافق') !== false) {
                    $q->orWhere('payments.status', 'approved');
                }
                if (mb_stripos($search, 'مرفوض') !== false) {
                    $q->orWhere('payments.status', 'rejected');
                }
            });
        }

        return $query;
    }

    private function statusBadge(Payment $payment): string
    {
        if ($payment->status === 'pending') {
            return '<span class="badge badge-light-warning">' . e($payment->status_label) . '</span>';
        }

        if ($payment->status === 'approved') {
            return '<span class="badge badge-light-success">' . e($payment->status_label) . '</span>';
        }

        return '<span class="badge badge-light-danger">' . e($payment->status_label) . '</span>';
    }
}
