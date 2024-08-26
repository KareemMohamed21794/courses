<!--begin::Modal - Edit-->
<div class="modal fade" id="kt_modal_update" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" id="kt_modal_update_form">
                @csrf
                @method('PUT')
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder">{{ __('messages.Update') }} {{$add_title}}</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_update_close" class="btn btn-icon btn-sm btn-active-icon-primary">
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
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_update_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_header" data-kt-scroll-wrappers="#kt_modal_update_scroll" data-kt-scroll-offset="300px">
                        
                        
                     <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.support_group') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <div onchange="SuportGroupUpdate()">
                                <input type="radio" id="support_group_update_yes" name="support_group_update" value="yes"  >
                                <label for="support_group_yes">نعم</label>
                                <input type="radio" id="support_group_update_no" name="support_group_update" value="no" checked>
                                <label for="support_group_no">لا</label>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div  id="suport_group_div_update">
                            <!--begin::Input-->
                             <select  name="suport_group_id[]" id="suport_group_update_id" aria-label="{{ __('messages.Select') }} {{ __('messages.support_group') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.support_group') }}"   class="form-select form-select-solid fw-bolder" multiple="" >
                                <option value="">{{ __('messages.Select') }} {{ __('messages.support_group') }}</option>
                            
                                    @foreach($leaders as $leader)
                                        <option value="{{$leader->id}}">{{ $leader->group_name }}</option>
                                    @endforeach
                                </select>

                        </div>
                        <!--end::Input group-->

                        
                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.study_place') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.study_place') }}" name="study_place"  id="study_place_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.study_location') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.study_location') }}" name="study_location"  id="study_location_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.practical_place') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.practical_place') }}" name="practical_place"  id="practical_place_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.practical_location') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.practical_location') }}" name="practical_location"  id="practical_location_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.proposed_time_study') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--begin::Input group-->
                          <div  >
                            <!--begin::Input-->
                             <select onchange="TimeStudyUpdate(this.value)" name="proposed_time_study" id="proposed_time_study_update" aria-label="{{ __('messages.Select') }} {{ __('messages.proposed_time_study') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.proposed_time_study') }}"   class="form-select form-select-solid fw-bolder">
                                <option value="">{{ __('messages.Select') }} {{ __('messages.proposed_time_study') }}</option>
                            
                                    
                                    <option value="connected">ايام متصله</option>

                                    <option value="separate">ايام منفصله</option>
                                    
                                </select>

                        </div>
                        <!--end::Input group-->
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div  id="connected_study_update">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.connected_from') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.connected_from') }}" name="connected_from"  id="connected_from_update"  />
                           
                            <!--end::Input-->


                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.connected_to') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.connected_to') }}" name="connected_to"  id="connected_to_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div  id="separate_study_update">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">ايام منفصله</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <a href="javascript:void(0)" onclick="addOtherPersonUpdate();" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <div class="other_person_container" style="margin-bottom: 20px;" id="append_container">
                               
                            </div>

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->





                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.type_qualification') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <!--begin::Input group-->
                          <div  >
                            <!--begin::Input-->
                             <select  name="type_qualification" id="type_qualification_update" aria-label="{{ __('messages.Select') }} {{ __('messages.type_qualification') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.type_qualification') }}"   class="form-select form-select-solid fw-bolder">
                                <option value="">{{ __('messages.Select') }} {{ __('messages.type_qualification') }}</option>
                            
                                    
                                    <option value="musaeid_qayid_alwahdih">مساعد قائد الوحده</option>

                                    <option value="qayid_alwahdih">قائد الوحده</option>
                                    
                                </select>

                        </div>
                        <!--end::Input group-->
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.maximum_number_students') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.maximum_number_students') }}" name="maximum_number_students"  id="maximum_number_students_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.proposed_study_supervisor') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.proposed_study_supervisor') }}" name="proposed_study_supervisor"  id="proposed_study_supervisor_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.qualification_study_supervisor') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.qualification_study_supervisor') }}" name="qualification_study_supervisor"  id="qualification_study_supervisor_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.vacation_number_supervisor') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.vacation_number_supervisor') }}" name="vacation_number_supervisor"  id="vacation_number_supervisor_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->





                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.proposed_study_leader') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.proposed_study_leader') }}" name="proposed_study_leader"  id="proposed_study_leader_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.qualification_study_leader') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.qualification_study_leader') }}" name="qualification_study_leader"  id="qualification_study_leader_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.vacation_number_leader') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.vacation_number_leader') }}" name="vacation_number_leader"  id="vacation_number_leader_update"  />
                           
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.list_supervisor') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <textarea name="list_supervisor"  id="list_supervisor_update" class="form-control form-control-solid" ></textarea>
                           
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
                    <button type="reset" id="kt_modal_update_cancel" class="btn btn-light me-3">{{ __('messages.Discard') }}</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_update_submit" class="btn btn-primary">
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
    </div>
</div>
<!--end::Modal - Branches - Edit-->
