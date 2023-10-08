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
                    <h2 class="fw-bolder">{{ __('messages.Update') }} {{ $add_title }}</h2>
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
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.name') }}" name="name"  id="name_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


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
                            <label class="fs-6 fw-bold mb-2">{{ __('messages.phone') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.phone') }}" name="phone"  id="phone_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">{{ __('messages.address') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea class="form-control form-control-solid" name="address"  id="address_update"></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        {{-- <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.Departments') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="department_id" id="department_id_update" aria-label="{{ __('messages.Select') }} {{ __('messages.Department') }}"   data-placeholder="{{ __('messages.Select') }} {{ __('messages.Department') }}" data-dropdown-parent="#kt_modal_update" class="form-select form-select-solid fw-bolder">
                                <option value="">{{ __('messages.Select') }} {{ __('messages.Department') }}</option>

                                @foreach($departments as $department)
                                    <option value="{{ $department->id }}">
                                        {{ $department->display_name }}
                                    </option>
                                @endforeach
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.Positions') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="position_id" id="position_id_update" aria-label="{{ __('messages.Select') }} {{ __('messages.Positions') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.Positions') }}" data-dropdown-parent="#kt_modal_update" class="form-select form-select-solid fw-bolder">
                                @foreach($positions as $position)
                                    <option value="{{ $position->id }}">
                                        {{ $position->display_name }}
                                    </option>
                                @endforeach


                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group--> --}}


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

                       {{--  <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.password_confirmation') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="password" class="form-control form-control-solid" placeholder="{{ __('messages.password_confirmation') }}" name="password_confirmation"  id="password_confirmation_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group--> --}}

                            {{-- <!--begin::Input group-->
                            <div class="fv-row mb-7">
                                <!--begin::Label-->
                                <label class="required fs-5 fw-bold mb-2">{{ __('messages.super_admin') }}</label>
                                <!--end::Label-->
                                <!--begin::Select-->
                                <select name="is_super" id="select_is_super_update" data-control="select2" data-hide-search="true" data-placeholder="{{ __('messages.is_super') }}" class="form-select form-select-solid">
                                    <option value="1">{{ __('messages.super_admin') }}</option>
                                    <option value="0">{{ __('messages.normal_admin') }}</option>
                                </select>
                                <!--end::Select-->
                            </div>
                            <!--end::Input group--> --}}

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
