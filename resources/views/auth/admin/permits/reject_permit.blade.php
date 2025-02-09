<!--begin::Modal - tasks - Add-->
<div class="modal fade" id="kt_modal_reject_request" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="{{ url('admin/reject_permit') }}" id="kt_modal_reject_request_form" data-kt-redirect="{{ url('admin/reject_permit') }}" method="POST">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_reject_request_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">سبب الرفض</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_reject_request_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_reject_request_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_reject_request_header" data-kt-scroll-wrappers="#kt_modal_reject_request_scroll" data-kt-scroll-offset="300px">
                        
                         

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">سبب الرفض</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" placeholder="سبب الرفض" name="reject_notes"  id="reject_notes"></textarea>
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
                    <button type="reset" id="kt_modal_reject_request_cancel" class="btn btn-light me-3">{{ __('messages.Discard') }}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_reject_request_submit" class="btn btn-primary">
                        <input type="hidden" name="permit_id"  id="permit_id" />
                        <span class="indicator-label">{{ __('messages.Submit') }}</span>
                        <span class="indicator-progress">{{ __('messages.Please wait') }}...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                <input type="hidden" name="type" id="type" value="rejected">
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - tasks - Add-->
 