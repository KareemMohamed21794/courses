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
                        <input type="text" data-kt-payments-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="بحث ذكي (هاتف، اسم، كورس، حالة...)" />
                    </div>
                </div>
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end flex-wrap gap-2" data-kt-payments-table-toolbar="base">
                        <select class="form-select form-select-solid w-150px" id="payment_status_filter">
                            <option value="all">كل الحالات</option>
                            <option value="pending">قيد المراجعة</option>
                            <option value="approved">موافق عليه</option>
                            <option value="rejected">مرفوض</option>
                        </select>
                        <select class="form-select form-select-solid w-200px" id="payment_course_filter">
                            <option value="all">كل الكورسات</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->title }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-light-primary" data-kt-payments-table-filter="reset">إعادة تعيين</button>
                        <div id="export_buttons"></div>
                    </div>
                </div>
            </div>
            <div class="card-body pt-0 table-responsive">
                <table id="kt_payments_table" class="table align-middle table-row-dashed fs-6 gy-5">
                    <thead>
                        <tr class="text-muted fw-bolder fs-7 text-uppercase">
                            <th>#</th>
                            <th>الكورس</th>
                            <th>رقم الهاتف</th>
                            <th>الاسم</th>
                            <th>إثبات الدفع</th>
                            <th>الحالة</th>
                            <th>التاريخ</th>
                            <th class="text-end">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="payments_get_url" value="{{ route('admin.payments.get') }}">
<input type="hidden" id="payments_export_url" value="{{ route('admin.payments.export') }}">
@endsection

@section('scripts')
<script src="{{ asset('demo1/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{ asset('demo1/dist/assets/js/custom/reports/export-buttons.js') }}"></script>
<script src="{{ asset('demo1/dist/assets/js/custom/apps/payments/list/list.js') }}"></script>
@endsection
