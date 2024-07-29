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
                       

                        <form class="panel-body" action="{{url('student_registration/')}}/{{$StudentRegistration->id}}" method="post">
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
                                        <label class="fs-6 fw-bold mb-2">{{ __('messages.page_description_ar') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid @error('description_ar') is-invalid @enderror" name="description_ar"  id="description_ar">{{$StudentRegistration->description_ar}}</textarea>
                                        @error('description_ar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->



                                     <!--begin::Input group-->
                                    <div class="fv-row mb-7">
                                        <!--begin::Label-->
                                        <label class="fs-6 fw-bold mb-2">{{ __('messages.page_description_en') }}</label>
                                        <!--end::Label-->
                                        <!--begin::Input-->
                                        <textarea class="form-control form-control-solid @error('description_en') is-invalid @enderror" name="description_en"  id="description_en">{{$StudentRegistration->description_en}}</textarea>
                                        @error('description_en')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                        <!--end::Input-->
                                    </div>
                                    <!--end::Input group-->


                                    <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3">
                                        <!--begin::Switch-->
                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                            <!--begin::Input-->
                                            

                                            <input class="form-check-input w-30px h-20px" type="checkbox" value="1" {{ $StudentRegistration->active == '1' ? 'checked' : '' }} name="active" id="active" />
                                            <!--end::Input-->
                                            <!--end::Label-->
                                            <span class="form-check-label text-muted fs-6">{{ __('messages.page_status') }}</span>
                                            <!--end::Label-->
                                        </label>
                                        <!--end::Switch-->
                                    </div>
                                </div>
                                <!--end::Menu item-->
                                  
             
                                </div>
                                <!--end::Scroll-->
                            </div>
                            <!--end::Modal body-->
                            <!--begin::Modal footer-->
                            <div class="modal-footer flex-center">
                                <!--begin::Button-->
                                {{-- <button type="reset" id="kt_modal_add_cancel" class="btn btn-light me-3">{{ __('messages.Discard') }}</button> --}}
                                <a href="{{url('student_registration')}}"> <button type="button" class="btn btn-light me-3">{{ __('messages.Discard') }}</button></a>
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

@section('scripts')
{{-- <script>
        ClassicEditor
            .create( document.querySelector( '#description_ar' ) )
            .catch( error => {
                console.error( error );
            } );


            ClassicEditor
            .create( document.querySelector( '#description_en' ) )
            .catch( error => {
                console.error( error );
            } );
</script> --}}

@endsection

