@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Card-->
            <div class="card">
               
             
                <!--begin::Card body-->
                <div class="card-body pt-0 table-responsive">
                    <!--begin::Form-->
                       

                        <form class="panel-body" action="{{url('admin/setup/')}}/{{$Setup->id}}" method="post" enctype="multipart/form-data">
                            @csrf 
                             @method('PUT') 
                            

                            <!--begin::Modal header-->
                            <div class="modal-header" id="kt_modal_add_header">
                                <!--begin::Modal title-->
                                <h2 class="fw-bolder">{{ __('messages.Update') }} {{$add_title}}</h2>
                                <!--end::Modal title-->
                                
                            </div>
                            <!--end::Modal header-->
                            <!--begin::Modal body-->
                            <div class="modal-body py-10 px-lg-17">
                                <!--begin::Scroll-->
                                <div class="scroll-y me-n7 pe-7" id="kt_modal_add_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_header" data-kt-scroll-wrappers="#kt_modal_add_scroll" data-kt-scroll-offset="100px">
                                  
                            
                                    <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">{{ __('messages.dead_line') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.dead_line') }}" name="dead_line"  id="dead_line_update" value="{{$Setup->dead_line}}" />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->



                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">{{ __('messages.commander_medal_date') }}</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.commander_medal_date') }}" name="commander_medal_date"  id="commander_medal_date_update" value="{{$Setup->commander_medal_date}}"/>
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج التسجيل السنوي</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج التسجيل السنوي" name="secondary_registration_file"  id="secondary_registration_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->



                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج الاداري السنوي</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج الاداري السنوي" name="administrative_file"  id="administrative_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج المالي السنوي</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج المالي السنوي" name="financial_file"  id="financial_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج  اجتماعات الهيئه العامه</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج  اجتماعات الهيئه العامه" name="board_director_meeting_file"  id="board_director_meeting_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج وسام القائد منذر</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج وسام القائد منذر" name="commander_medal_file"  id="commander_medal_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->

                                  <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Label-->
                                    <label class="required fs-6 fw-bold mb-2">نموذج انجازات متطلبات دراسه</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <input type="file" class="form-control form-control-solid" placeholder="نموذج انجازات متطلبات دراسه" name="achievement_study_requirement_file"  id="achievement_study_requirement_file"  />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                {{-- <button type="reset" id="kt_modal_add_cancel" class="btn btn-light me-3">{{ __('messages.Discard') }}</button> --}}
                                {{-- <a href="{{url('admin/setup')}}"> <button type="button" class="btn btn-light me-3">{{ __('messages.Discard') }}</button></a> --}}
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit"  class="btn btn-primary">
                                    <span class="indicator-label">{{ __('messages.Submit') }}</span>
                                    <span class="indicator-progress">{{ __('messages.Please wait') }}...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                            <!--end::Modal footer-->
                            <input type="hidden" name="id"  id="id" />
                        </form>
                        <!--end::Form-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
           
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
  


@endsection

