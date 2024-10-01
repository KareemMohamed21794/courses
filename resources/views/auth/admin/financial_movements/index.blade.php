@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
    <input type="hidden" name="can_add" id="can_add" value="{{ $can_add }}">
    <input type="hidden" name="can_update" id="can_update" value="{{ $can_update }}">
    <input type="hidden" name="can_delete" id="can_delete" value="{{ $can_delete }}">
    <input type="hidden" name="can_print" id="can_print" value="{{ $can_print }}">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
                <!--begin::Card header-->
                <div class="card-header border-0 pt-6">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <!--begin::Search-->
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="{{__('messages.Search')}}" />
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--begin::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <!--begin::Toolbar-->
                        <div class="d-flex justify-content-end" data-kt-docs-table-toolbar="base">
                            <!--begin::Filter-->
                            <button style="display: none;" type="button" class="btn btn-light-primary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->{{ __('messages.Filter') }}</button>
                            <!--begin::Menu 1-->
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true" id="kt-toolbar-filter">
                                <!--begin::Header-->
                                <div class="px-7 py-5">
                                    <div class="fs-4 text-dark fw-bolder">{{ __('messages.Filter Options') }}</div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Separator-->
                                <div class="separator border-gray-200"></div>
                                <!--end::Separator-->
                                <!--begin::Content-->
                                <div class="px-7 py-5">
                                    <!--begin::Input group-->
                                    <div class="mb-10">
                                        <!--begin::Label-->
                                        <label class="form-label fs-5 fw-bold mb-3">{{ __('messages.Active') }}:</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="Select option" data-allow-clear="true" data-kt-branch-table-filter="active" data-dropdown-parent="#kt-toolbar-filter" id="active">
                                            <option value="All">{{ __('messages.ALL') }}</option>
                                            <option value="Active">{{ __('messages.Active') }}</option>
                                            <option value="DeActive">{{ __('messages.DeActive') }}</option>
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->



                                    <!--begin::Actions-->
                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true" data-kt-docs-table-filter="reset">{{ __('messages.Reset') }}</button>
                                        <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-docs-table-filter="filter">{{ __('messages.Apply') }}</button>
                                    </div>
                                    <!--end::Actions-->
                                </div>
                                <!--end::Content-->
                            </div>
                          
                            <!--end::Menu 1-->
                            <!--end::Filter-->
                           
                       
                            @if($can_add == 1 )
                            <!--begin::Add-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add">{{ __('messages.Add') }} {{ $add_title }}</button>
                            <!--end::Add-->
                            @endif
                          
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Group actions-->
                        <div class="d-flex justify-content-end align-items-center d-none" data-kt-docs-table-toolbar="selected">
                            <div class="fw-bolder me-5">
                            <span class="me-2" data-kt-docs-table-select="selected_count"></span>{{ __('messages.Selected') }}</div>
                            <button type="button" class="btn btn-danger" data-kt-docs-table-select="delete_selected">{{ __('messages.Delete Selected') }}</button>
                        </div>
                        <!--end::Group actions-->
                    </div>
                    <!--end::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive">
                    <!--begin::Datatable-->
                    <table id="kt_datatable_table" class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            @if($can_delete == 1 )
                            <th class="w-10px pe-2">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table .form-check-input" value="1"/>
                                </div>
                            </th>
                            @else
                            <th class="w-10px pe-2" style="visibility: hidden;">
                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_datatable_table .form-check-input" value="1"/>
                                </div>
                            </th>
                            @endif
                            <th>#</th>
                            <th>{{ __('messages.scout_group') }}</th>
                            <th>{{ __('messages.price') }}</th>
                            <th>{{ __('messages.receipt_number') }}</th>
                            <th>{{ __('messages.date') }}</th>
                            <th>{{ __('messages.payment_method') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                            
                            <th class="text-end min-w-100px actions">{{ __('messages.Actions') }}</th>
                           
                        </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-bold">
                        </tbody>
                    </table>
                    <!--end::Datatable-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            @include('auth.admin.financial_movements.add')
            @include('auth.admin.financial_movements.update')
            
            <!--begin::Modal - Adjust Balance-->
            @include('auth.admin.financial_movements.export')
            <!--end::Modal - New Card-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
   <input type="hidden" name="is_super" id="is_super" value="{{ $objAdmin->is_super }}">
@endsection

@section('scripts')

    <!--begin::Page Vendors Javascript(used by this page)-->
    <script src="{{ asset('demo1/dist/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/financial_movements/list/export.js') }}"></script>
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/financial_movements/list/list.js') }}"></script>
     
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/financial_movements/add.js') }}"></script>
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/financial_movements/update.js') }}"></script>

 
    <!--end::Page Custom Javascript-->
@endsection

{{-- @if($objAdmin->is_super == 0)
<style type="text/css">
    .group_name{
        display: none;
    }
</style>
@endif --}}

