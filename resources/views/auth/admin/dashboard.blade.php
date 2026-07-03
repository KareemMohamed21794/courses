@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
@if($objAdmin->is_super == 1 || $objAdmin->position_id == 3|| $objAdmin->position_id == 4)
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            
                <!--begin::Row-->
                <div class="row g-5 g-xl-8">
                    <div class="col-xl-4">
                        <a href="{{ route('admin.courses.index') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_courses }}</div>
                                <div class="fw-bold text-gray-400">الكورسات</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4">
                        <a href="{{ route('admin.payments.index') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_pending_payments }}</div>
                                <div class="fw-bold text-gray-400">طلبات قيد المراجعة</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4">
                        <div class="card bg-body hoverable card-xl-stretch mb-xl-8">
                            <div class="card-body">
                                <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_approved_users }}</div>
                                <div class="fw-bold text-gray-400">مشتركين معتمدين</div>
                            </div>
                        </div>
                    </div>
                    @if($objAdmin->is_super == 1 || $objAdmin->position_id == 2)
                    <div class="col">
                        <!--begin::Statistics Widget 5-->
                        <a href="{{ url('/admin/leaders') }}" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                                <!--begin::Body-->
                                <div class="card-body">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                    <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                                        <svg height="24" width="24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                     viewBox="0 0 24 24" xml:space="preserve">
                                    <g id="group">
                                        <path d="M24,15.9c0-2.8-1.5-5-3.7-6.1C21.3,8.8,22,7.5,22,6c0-2.8-2.2-5-5-5c-2.1,0-3.8,1.2-4.6,3c0,0,0,0,0,0c-0.1,0-0.3,0-0.4,0
                                        c-0.1,0-0.3,0-0.4,0c0,0,0,0,0,0C10.8,2.2,9.1,1,7,1C4.2,1,2,3.2,2,6c0,1.5,0.7,2.8,1.7,3.8C1.5,10.9,0,13.2,0,15.9V20h5v3h14v-3h5
                                        V15.9z M17,3c1.7,0,3,1.3,3,3c0,1.6-1.3,3-3,3c0-1.9-1.1-3.5-2.7-4.4c0,0,0,0,0,0C14.8,3.6,15.8,3,17,3z M13.4,4.2
                                        C13.4,4.2,13.4,4.2,13.4,4.2C13.4,4.2,13.4,4.2,13.4,4.2z M15,9c0,1.7-1.3,3-3,3s-3-1.3-3-3s1.3-3,3-3S15,7.3,15,9z M10.6,4.2
                                        C10.6,4.2,10.6,4.2,10.6,4.2C10.6,4.2,10.6,4.2,10.6,4.2z M7,3c1.2,0,2.2,0.6,2.7,1.6C8.1,5.5,7,7.1,7,9C5.3,9,4,7.7,4,6S5.3,3,7,3
                                        z M5.1,18H2v-2.1C2,13.1,4.1,11,7,11v0c0,0,0,0,0,0c0.1,0,0.2,0,0.3,0c0,0,0,0,0,0c0.3,0.7,0.8,1.3,1.3,1.8
                                        C6.7,13.8,5.4,15.7,5.1,18z M17,21H7v-2.1c0-2.8,2.2-4.9,5-4.9c2.9,0,5,2.1,5,4.9V21z M22,18h-3.1c-0.3-2.3-1.7-4.2-3.7-5.2
                                        c0.6-0.5,1-1.1,1.3-1.8c0.1,0,0.2,0,0.4,0v0c2.9,0,5,2.1,5,4.9V18z"/>
                                    </g>
                                    </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">{{ $count_users }}</div>
                                    <div class="fw-bold text-gray-400">{{ __('messages.users') }}</div>
                                </div>
                                <!--end::Body-->
                            </a>
                            <!--end::Statistics Widget 5-->
                    </div>

                   
                    @endif

      

                </div>
                <!--end::Row-->
                <br>
          

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
    @endif
@endsection