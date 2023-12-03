<!--begin::Modal Add-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_add_form" data-kt-redirect="{{ url('admin/advertisements') }}"method="POST">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('messages.Add') }} {{$add_title}}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_add_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_header" data-kt-scroll-wrappers="#kt_modal_add_scroll" data-kt-scroll-offset="300px">
                      
                     <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-5 fw-bold mb-2">{{ __('messages.group_classification') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select onchange="group_classification(this.value)" name="group_type" id="group_type"  data-placeholder="{{ __('messages.group_classification') }}" class="form-select form-select-solid">
                                <option value="">اختر</option>
                                <option value="all">الكل</option>
                                <option value="kashfih">كشفية</option>
                                <option value="irshad">ارشادية</option>
                                
                                <option value="group_name">اسم المجموعة</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Input group-->





                          <!--begin::Input group-->
                        <div class="fv-row mb-7" id="group_div">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.scout_group') }}</span>
                                 
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="admin_id[]" id="admin_id" aria-label="{{ __('messages.Select') }} " data-control="select2" data-placeholder="{{ __('messages.Select') }} " data-dropdown-parent="#kt_modal_add" class="form-select form-select-solid fw-bolder" multiple>
                                <option value="0">{{ __('messages.Select') }} </option>
                                
                                 @foreach($leaders as $leader)
                                        <option value="{{$leader->id}}">{{ $leader->group_name }}</option>
                                    @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                 



                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">الملف</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="file" class="form-control form-control-solid" placeholder="الملف" name="file"  id="file"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">اسم الملف</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="اسم الملف" name="file_name"  id="file_name"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">الشرح</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <textarea name="description"  id="description" class="form-control form-control-solid" ></textarea>
                           
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
                    <button type="reset" id="kt_modal_add_cancel" class="btn btn-light me-3">{{ __('messages.Discard') }}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_add_submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('messages.Submit') }}</span>
                        <span class="indicator-progress">{{ __('messages.Please wait') }}...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Branches - Add-->
