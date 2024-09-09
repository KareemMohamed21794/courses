@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
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
                            @if($objAdmin->is_super == 1)
                                <!--begin::Export-->
                        <!--     <div id="export_buttons" style="margin-left: 10px;"></div> -->
                           <a href="{{url('admin/export_achievements_study_requirements')}}" class="menu-link px-3">
                            <button type="button" class="btn btn-light-primary me-3" >
                           <!--  <button style="display: none;" type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_export_modal"> -->
                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr078.svg-->
                            <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.3" x="12.75" y="4.25" width="12" height="2" rx="1" transform="rotate(90 12.75 4.25)" fill="black" />
                                    <path d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z" fill="black" />
                                    <path d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z" fill="#C4C4C4" />
                                </svg>
                            </span>
                            
                            <!--end::Svg Icon-->{{ __('messages.Export') }}</button>
                            <!--end::Export-->
                        </a>
                        @endif

                        <!--begin::Download Form-->
                         <a href="{{ url('public/') }}/achievements_study_requirements.doc" class="menu-link px-3">
                            <button type="button" class="btn btn-light-primary me-3" >
                         
                            <span class="svg-icon svg-icon-2">
                               
                            </span>
                            
                            <!--end::Svg Icon-->{{ __('messages.Download_Form') }}</button>
                           
                        </a>
                        <!--end::Download Form-->
                         @if($check_date)
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
                            @if($objAdmin->is_super == 1)
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
                            <th> الملف  </th>
                             <th>{{ __('messages.year') }}</th>
                             <th>{{ __('messages.status') }}</th>
                           
                            <th>{{ __('messages.reject_notes') }}</th>
                            <th>{{ __('messages.created_at') }}</th>
                             @if($objAdmin->is_super == 1)
                            <th class="text-end min-w-100px actions">{{ __('messages.Actions') }}</th>
                            @else
                            <th class="text-end min-w-100px actions" style="visibility: hidden;">{{ __('messages.Actions') }}</th>
                            @endif
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
            @include('auth.admin.commander_medals.add')
            @include('auth.admin.commander_medals.update')
            @include('auth.admin.commander_medals.reject')
            <!--begin::Modal - Adjust Balance-->
            @include('auth.admin.commander_medals.export')
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
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/commander_medals/list/export.js') }}"></script>
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/commander_medals/list/list.js') }}"></script>
     <script src="{{ asset('demo1/dist/assets/js/custom/apps/commander_medals/reject.js') }}"></script>
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/commander_medals/add.js') }}"></script>
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/commander_medals/update.js') }}"></script>

 
    <!--end::Page Custom Javascript-->
@endsection

@if($objAdmin->is_super == 0)
<style type="text/css">
    .group_name{
        display: none;
    }
</style>
@endif

