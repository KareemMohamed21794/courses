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
                                  @if($objAdmin->is_super == 1)
                                <br>

                            <form class="form" action="#" id="kt_modal_add_form" data-kt-redirect="{{ url('admin/total_secondary_registration') }}"method="get">
             
                                 <!--begin::Input group-->
                                    <div class="d-flex flex-column mb-7 fv-row">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">
                                            <span class="required">{{ __('messages.scout_group') }}</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <select name="admin_id" id="admin_id" aria-label="{{ __('messages.Select') }} {{ __('messages.scout_group') }}"   data-placeholder="{{ __('messages.Select') }} {{ __('messages.scout_group') }}" data-dropdown-parent="#kt_modal_add" class="form-select form-select-solid fw-bolder">
                                             <option value="">{{ __('messages.Select') }}</option >
                                                @foreach($leaders as $leader)
                                                    <option {{$leader->id == $admin_id ? 'selected' : ''}} value="{{$leader->id}}">{{ $leader->group_name }}</option>
                                                @endforeach
                                        </select>
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->
                                

                                      <button type="submit"  class="btn btn-primary">
                                    {{ __('messages.Search') }}</button>
                                <!--end::Button-->
                                </form>
                        @endif
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
                            <!--begin::Export-->
                            
                            <!--begin::Add-->
                          
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
                    <!--begin::Datatable-->
                    <table id="kt_datatable_table" class="table align-middle table-row-dashed fs-6 gy-5 ">
                        <thead>
                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>{{ __('messages.scout_group') }}</th>
                            <th>{{$objAdmin_group->group_name}}</th> 
                        </tr>
                      

                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>له</th>
                            <th>{{$total_debit}}</th> 
                        </tr>


                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>عليه</th>
                            <th>{{$total_credit}} </th> 
                        </tr>



                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                            <th>الباقي</th>
                            <th>{{$remain}}</th> 
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
        
            <!--begin::Modal - Adjust Balance-->
            @include('auth.admin.secondary_registrations.export')
            <!--end::Modal - New Card-->
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
   
@endsection



@if($objAdmin->is_super == 0)
<style type="text/css">
    .group_name{
        display: none;
    }
</style>
@endif

