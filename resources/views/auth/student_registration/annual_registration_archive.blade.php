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
                            

                            <!--begin::Add-->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add">{{ __('messages.Add') }} {{ $add_title }}</button>
                            <!--end::Add-->
                          
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
                   
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
            <!--begin::Modals-->
            @include('auth.student_registration.add_annual_registration_archive')
            
            
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
    
    
    <script src="{{ asset('demo1/dist/assets/js/custom/apps/student_registration/add_annual_registration_archive.js') }}"></script>
    
 
    <!--end::Page Custom Javascript-->
@endsection


