@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
<div class="post d-flex flex-column-fluid" id="kt_post">
    <div id="kt_content_container" class="container-xxl">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="card">
            <div class="card-header border-0 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <span class="svg-icon svg-icon-1 position-absolute ms-6">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                            </svg>
                        </span>
                        <input type="text" data-kt-subscriptions-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="بحث (هاتف، اسم، كورس، حالة...)" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end flex-wrap gap-2">
                        <select class="form-select form-select-solid w-150px" id="subscription_status_filter">
                            <option value="all">كل الحالات</option>
                            <option value="pending">قيد المراجعة</option>
                            <option value="approved">موافق عليه</option>
                            <option value="rejected">مرفوض</option>
                            <option value="expired">منتهي</option>
                        </select>
                        <select class="form-select form-select-solid w-200px" id="subscription_course_filter">
                            <option value="all">كل الكورسات</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-light-primary" data-kt-subscriptions-table-filter="reset">إعادة تعيين</button>
                        <div id="export_buttons"></div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0 table-responsive">
                <table id="kt_subscriptions_table" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-muted fw-bolder fs-7 text-uppercase">
                            <th>#</th>
                            <th>الكورس</th>
                            <th>الهاتف</th>
                            <th>الاسم</th>
                            <th>الخطة</th>
                            <th>إثبات</th>
                            <th>الحالة</th>
                            <th>البداية</th>
                            <th>الانتهاء</th>
                            <th>المتبقي</th>
                            <th>تاريخ الطلب</th>
                            <th class="text-end">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="approveModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" id="approveForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">الموافقة على الاشتراك</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="form-label">تاريخ بداية الاشتراك</label>
                    <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d') }}">
                    <div class="form-text">سيتم حساب تاريخ الانتهاء تلقائياً حسب مدة الخطة.</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success">تأكيد الموافقة</button>
                </div>
            </div>
        </form>
    </div>
</div>

<input type="hidden" id="subscriptions_get_url" value="{{ route('admin.subscriptions.get') }}">
<input type="hidden" id="subscriptions_export_url" value="{{ route('admin.subscriptions.export') }}">
@endsection

@section('scripts')
<script src="{{ asset('demo1/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('demo1/dist/assets/js/custom/reports/export-buttons.js') }}"></script>
<script src="{{ asset('demo1/dist/assets/js/custom/apps/subscriptions/list/list.js') }}"></script>
<script>
document.getElementById('approveModal').addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    document.getElementById('approveForm').action = button.getAttribute('data-action');
});
</script>
@endsection
