@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            @if(Auth::guard('admin')->check())
                @if(Auth::user()->is_super)
                    <!--begin::Row-->
                    <div class="row g-5 g-xl-8">
                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('/admin/admins') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                            <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                            <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                            <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_admins }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.Admins') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('/admin/lawyers') }}" class="card bg-dark hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                    <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                                            <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                                            <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">{{ $count_lawyers }}</div>
                                    <div class="fw-bold text-gray-100">{{ __('messages.lawyers') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('/admin/secretariats') }}" class="card bg-warning hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                                            <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $count_secretariats }}</div>
                                    <div class="fw-bold text-white">{{ __('messages.secretariats') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                        <div class="col-xl-3">
                            <!--begin::Statistics Widget 5-->
                            <a href="{{ url('/admin/clients') }}" class="card bg-info hoverable card-xl-stretch mb-5 mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z" fill="black" />
                                            <path d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z" fill="black" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ $count_clients }}</div>
                                    <div class="fw-bold text-white">{{ __('messages.clients') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                        </div>
                    </div>
                    <!--end::Row-->
                @endif
            @endif


            @if(Auth::guard('admin')->check())
                
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{ url('/admin/problems/procedure') }}" class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black" />
                                        <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black" />
                                        <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ __('messages.claims_and_procedures') }}</div>
                                <div class="fw-bold text-white">{{ $count_procedure }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-6">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{ url('/admin/problems/case') }}" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body">
                                <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="black" />
                                        <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="black" />
                                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ __('messages.case') }}</div>
                                <div class="fw-bold text-white">{{ $count_case }}</div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
                <!--end::Row-->


                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                     
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::Tables Widget 5-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">{{ __('messages.claims_and_procedures') }}</span>
                                     
                                </h3>
                                <div class="card-toolbar">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_1">{{ __('messages.day') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_2">{{ __('messages.week') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark  fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_3">{{ __('messages.month') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade   show active" id="kt_table_widget_5_tab_1">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($daily_procedures as $daily_procedure)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$daily_procedure->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.date_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.deadline') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->problem->deadline }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.problem_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->problem->problem_number }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($daily_procedure->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($daily_procedure->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.progress') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_procedure->problem->calculateProgressPercentage() }} %</span>
                                                             
                                                        </td>

                                                        

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $daily_procedure->problem->id }}?problems_procedure_id={{ $daily_procedure->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_table_widget_5_tab_2">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($weekly_procedures as $weekly_procedure)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$weekly_procedure->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.date_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.deadline') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->problem->deadline }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.problem_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->problem->problem_number }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($weekly_procedure->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($weekly_procedure->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.progress') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_procedure->problem->calculateProgressPercentage() }} %</span>
                                                             
                                                        </td>

                                                        

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $weekly_procedure->problem->id }}?problems_procedure_id={{ $weekly_procedure->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_table_widget_5_tab_3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($monthly_procedures as $monthly_procedure)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$monthly_procedure->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.date_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.deadline') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->problem->deadline }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.problem_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->problem->problem_number }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_procedure') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($monthly_procedure->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($monthly_procedure->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.progress') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_procedure->problem->calculateProgressPercentage() }} %</span>
                                                             
                                                        </td>

                                                        

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $monthly_procedure->problem->id }}?problems_procedure_id={{ $monthly_procedure->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Tables Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->


                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                     
                    <!--begin::Col-->
                    <div class="col-xl-12">
                        <!--begin::Tables Widget 5-->
                        <div class="card card-xxl-stretch mb-5 mb-xl-8">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bolder fs-3 mb-1">{{ __('messages.cases') }}</span>
                                     
                                </h3>
                                <div class="card-toolbar">
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_4">{{ __('messages.day') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark fw-bolder px-4 me-1" data-bs-toggle="tab" href="#kt_table_widget_5_tab_5">{{ __('messages.week') }}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-dark  fw-bolder px-4" data-bs-toggle="tab" href="#kt_table_widget_5_tab_6">{{ __('messages.month') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!--end::Header-->
                            <!--begin::Body-->
                            <div class="card-body py-3">
                                <div class="tab-content">
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade   show active" id="kt_table_widget_5_tab_4">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($daily_cases as $daily_case)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_case->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$daily_case->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.court') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_case->problem->court }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.next_session_date') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_case->next_session_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.case_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_case->problem->problem_number."/".$daily_case->problem->problem_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_case') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $daily_case->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($daily_case->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($daily_case->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                         

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $daily_case->problem->id }}?problems_procedure_id={{ $daily_case->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_table_widget_5_tab_5">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($weekly_cases as $weekly_case)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_case->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$weekly_case->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.next_session_date') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_case->next_session_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.court') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_case->problem->court }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.case_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_case->problem->problem_number."/".$weekly_case->problem->problem_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_case') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $weekly_case->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($weekly_case->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($weekly_case->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                         

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $weekly_case->problem->id }}?problems_procedure_id={{ $weekly_case->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr> 
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                    <!--begin::Tap pane-->
                                    <div class="tab-pane fade" id="kt_table_widget_5_tab_6">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-200 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="border-0">
                                                         
                                                        <th class="p-0 min-w-150px"></th>
                                                        <th class="p-0 min-w-140px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-110px"></th>
                                                        <th class="p-0 min-w-50px"></th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    
                                                    @foreach($monthly_cases as $monthly_case)
                                                    <tr>
                                                         
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Staff') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_case->problem->staff->name }}</span>
                                                             
                                                        </td>
                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.clients') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ @$monthly_case->problem->client->display_name }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.next_session_date') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_case->next_session_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.court') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_case->problem->court }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.case_number') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_case->problem->problem_number."/".$monthly_case->problem->problem_date }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.subject_case') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ $monthly_case->problem->subject }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Cost') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($monthly_case->problem->calculateTotalCost(),2) }}</span>
                                                             
                                                        </td>

                                                        <td>
                                                            <a href="#" class="text-dark fw-bolder text-hover-primary mb-1 fs-6">{{ __('messages.Total_Duration') }}</a>
                                                            <span class="text-muted fw-bold d-block">{{ number_format($monthly_case->problem->calculateTotalDuration(),2) }}</span>
                                                             
                                                        </td>

                                                         

                                                        <td class="text-end">
                                                            <a href="{{ url('/admin/problems_procedure') }}/{{ $monthly_case->problem->id }}?problems_procedure_id={{ $monthly_case->id }}" class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary">
                                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                        <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                                        <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                                                    </svg>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </a>
                                                        </td>
                                                    </tr>  
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                        </div>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Tap pane-->
                                </div>
                            </div>
                            <!--end::Body-->
                        </div>
                        <!--end::Tables Widget 5-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->



            @endif
             
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
@endsection