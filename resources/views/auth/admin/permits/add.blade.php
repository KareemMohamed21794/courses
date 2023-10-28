<!--begin::Modal Add-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_add_form" data-kt-redirect="{{ url('admin/permits') }}"method="POST">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('messages.Add') }} {{$title}}</h2>
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


                    @if($objAdmin->is_super == 1)


                     <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.scout_group') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="leader_id" id="leader_id" aria-label="{{ __('messages.Select') }} {{ __('messages.scout_group') }}"   data-placeholder="{{ __('messages.Select') }} {{ __('messages.scout_group') }}" data-dropdown-parent="#kt_modal_add" class="form-select form-select-solid fw-bolder">
                                 <option value="">{{ __('messages.Select') }}</option >
                                    @foreach($leaders as $leader)
                                        <option value="{{$leader->id}}">{{ $leader->name }}</option>
                                    @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                    @endif
                      

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.activity_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.activity_name') }}" name="activity_name"  id="activity_name" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                           <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.nature_activity') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           <select onchange="NaturalActivity(this.value)" name="nature_activity" id="nature_activity" data-placeholder="{{ __('messages.nature_activity') }}" class="form-select form-select-solid">
                                <option value="">{{ __('messages.nature_activity') }}</option>
                                <option value="camp">مخيم</option>
                                <option value="trip">رحلة</option>
                                <option value="marching">مسير </option>
                                <option value="overnight">مبيت</option>
                                <option value="evening">امسيه</option>
                                <option value="other">اخرى</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="other_activity_description">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.activity_description') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.activity_description') }}" name="activity_description"  id="activity_description" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.place_activity') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place_activity') }}" name="place_activity"  id="place_activity" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                       

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" >
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.activity_history') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.activity_history') }}" name="activity_history"  id="activity_history" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.number_days') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.number_days') }}" name="number_days"  id="number_days" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.alwahda') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           <select onchange="Alwahda(this.value)" name="alwahda" id="alwahda" data-placeholder="{{ __('messages.alwahda') }}" class="form-select form-select-solid">
                                <option value="">{{ __('messages.alwahda') }}</option>
                                <option value="ashbal">اشبال /  زهرات</option>
                                <option value="kashaf">كشاف / مرشدات</option>
                                <option value="mutaqadimu">متقدم / متقدمات </option>
                                <option value="jawaluh">جواله / دليلات</option>
                                <option value="almajmueuh">المجموعه</option>
                                <option value="awlia_alamwr"> اولياء الامور</option>
                                <option value="other">اخرى</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="other_alwahda_description">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.alwahda_description') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.alwahda_description') }}" name="alwahda_description"  id="alwahda_description" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.activity_leader') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.activity_leader') }}" name="activity_leader"  id="activity_leader" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.number_leader') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.number_leader') }}" name="number_leader"  id="number_leader" />
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
