<!--begin::Modal - Branches - Edit-->
<div class="modal fade" id="kt_modal_update" tabindex="-1" aria-hidden="true">
	<!--begin::Modal dialog-->
	<div class="modal-dialog modal-dialog-centered mw-650px">
		<!--begin::Modal content-->
		<div class="modal-content">
			<!--begin::Form-->
			<form class="form" action="#" id="kt_modal_update_form" data-kt-redirect="{{ url('admin/admins') }}">
				<!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_update_header">
                    <!--begin::Modal title-->
                    <h2 id="myHeading" class="fw-bolder">{{ __('messages.Update') }} {{ $add_title }}</h2>
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
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.username') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input style="cursor: not-allowed;" type="text" readonly class="form-control form-control-solid" placeholder="{{ __('messages.username') }}" name="username_update"  id="username_update"  autocomplete="false" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        @if(request()->segment(2)=='admins')
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.name') }}" name="name"  id="name_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        @endif


                      


                        @if(request()->segment(2)=='leaders')
                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.group_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.group_name') }}" name="group_name"  id="group_name_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        @endif



                             <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.email') }}" name="email"  id="email_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                             <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.phone') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.phone') }}" name="phone"  id="phone_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                         @if($objAdmin->is_super)
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.password') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="password" class="form-control form-control-solid" placeholder="{{ __('messages.password') }}" name="password"  id="password_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        @endif

                       

                        

                        @if(request()->segment(2)=='leaders')

                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.registration_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.registration_number') }}" name="registration_number"  id="registration_number_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         
                        
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-5 fw-bold mb-2">{{ __('messages.registration_type') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select onchange="RegistrationTypeUpdate(this.value)" name="registration_type" id="registration_type_update"  data-placeholder="{{ __('messages.registration_type') }}" class="form-select form-select-solid">
                                <option value="">اختر</option>
                                <option value="harah">حرة</option>
                                <option value="muqiaduh">مقيدة</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Input group-->
                        



                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="alhayyuh_almuqayaduh_id_update">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.alhayyuh_almuqayaduh') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.alhayyuh_almuqayaduh') }}" name="alhayyuh_almuqayaduh"  id="alhayyuh_almuqayaduh_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="alhayyuh_almuqayaduh_number_id_update">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2" id="labelElement_update">{{ __('messages.alhayyuh_almuqayaduh_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.alhayyuh_almuqayaduh_number') }}" name="alhayyuh_almuqayaduh_number_update"  id="alhayyuh_almuqayaduh_number_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-5 fw-bold mb-2">{{ __('messages.group_classification') }}</label>
                            <!--end::Label-->
                            <!--begin::Select-->
                            <select name="group_classification" id="group_classification_update"  data-placeholder="{{ __('messages.group_classification') }}" class="form-select form-select-solid">
                                <option value="">اختر</option>
                                <option value="kashfih">كشفية</option>
                                <option value="irshad">ارشادية</option>
                            </select>
                            <!--end::Select-->
                        </div>
                        <!--end::Input group-->

                        



                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.date_establishment') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.date_establishment') }}" name="date_establishment"  id="date_establishment_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        

                        @endif


                     


                   


                        


                      
                        @if(request()->segment(2)=='leaders')

                       


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.website') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.website') }}" name="website"  id="website_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        

                        

                       <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span >{{ __('messages.governorate') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="governorate" id="governorate_update" aria-label="{{ __('messages.Select') }} {{ __('messages.governorate') }}"   data-placeholder="{{ __('messages.Select') }} {{ __('messages.governorate') }}" data-dropdown-parent="#kt_modal_update" class="form-select form-select-solid fw-bolder">
                                <option value="">{{ __('messages.Select') }} {{ __('messages.governorate') }}</option>

                                @foreach($Governorates as $governorate)
                                    <option value="{{ $governorate }}">
                                        {{ $governorate }}
                                    </option>
                                @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                     
                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.district') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.district') }}" name="district"  id="district_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.street_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.street_name') }}" name="street_name"  id="street_name_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.building_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.building_number') }}" name="building_number"  id="building_number_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                     

                        
                        




                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.workplace') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.workplace') }}" name="workplace"  id="workplace_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.job') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.job') }}" name="job"  id="job_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.leaders_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.leaders_number') }}" name="leaders_number"  id="leaders_number_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.persons_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.persons_number') }}" name="persons_number"  id="persons_number_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.groups') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="number" class="form-control form-control-solid" placeholder="{{ __('messages.groups') }}" name="groups"  id="groups_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        @endif

                        

                       

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
