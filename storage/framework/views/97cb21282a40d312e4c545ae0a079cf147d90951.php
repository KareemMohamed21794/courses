<div class="modal fade" id="kt_export_modal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header">
                <!--begin::Modal title-->
                <h2 class="fw-bolder"><?php echo e(__('messages.Export')); ?></h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div id="kt_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <!--begin::Form-->
                <form id="kt_export_form" class="form" action="#">
                     
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-5"><?php echo e(__('messages.Select Export Format')); ?>:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                         <div id="export_buttons"></div>
                    </div>
                    <!--end::Input group-->
                     
                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="kt_export_cancel" class="btn btn-light me-3"><?php echo e(__('messages.Discard')); ?></button>
                        <button type="submit" id="kt_export_submit" class="btn btn-primary">
                            <span class="indicator-label"><?php echo e(__('messages.Ok')); ?></span>
                            <span class="indicator-progress"><?php echo e(__('messages.Please wait')); ?>...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div><?php /**PATH E:\xampp\htdocs\courses\resources\views/auth/admin/admins/export.blade.php ENDPATH**/ ?>