<!--begin::Modal Add-->
<div class="modal fade" id="kt_modal_add" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-850px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="kt_modal_add_form" data-kt-redirect="{{ url('admin/group_leaders') }}"method="POST">
                @csrf
                <!--begin::Modal header-->
                <div class="modal-header" id="kt_modal_add_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder"> {{$add_title}}</h2>
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
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.first_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.first_name') }}" name="first_name"  id="first_name"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->




                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.father_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.father_name') }}" name="father_name"  id="father_name"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                        


                        <!--begin::Input group-->
                        <div class="fv-row mb-7" >
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.grandfather_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.grandfather_name') }}" name="grandfather_name"  id="grandfather_name"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                       

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" >
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.family_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.family_name') }}" name="family_name"  id="family_name"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.birth_place') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.birth_place') }}" name="birth_place"  id="birth_place"  />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                          <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.birth_date') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.birth_date') }}" name="birth_date"  id="birth_date" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.Profession') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.Profession') }}" name="job"  id="job" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->




                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.scout_qualification') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.scout_qualification') }}" name="scout"  id="scout" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->




                        <!--begin::Input group-->
                        <div class="fv-row mb-7" style="display: none;">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.specialization') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.specialization') }}" name="specialization_scout"  id="specialization_scout" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.year') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.year') }}" name="year_scout"  id="year_scout" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.place') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place') }}" name="place_scout"  id="place_scout" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.vacation_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.vacation_number') }}" name="vacation_scout"  id="vacation_scout" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.notes') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           
                            <textarea type="text" class="form-control form-control-solid" placeholder="{{ __('messages.notes') }}" name="note_scout"  id="note_scout" ></textarea>
                            <!--end:: Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.previous_scouting_experiences') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <a href="javascript:void(0)" onclick="addOtherPerson();" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="black"></rect>
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="black"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <div class="other_person_container" style="margin-bottom: 20px;">
                                <div class="input-group other_person_other_lawer">
                                    <input type="text" class="form-control form-control-solid other_lawers" placeholder="{{ __('messages.Place_group') }}" name="Place_group[]"  />

                                    <div style="margin-left: 10px;"></div> <!-- Add this div for spacing -->

                                    <input type="text" class="form-control form-control-solid other_lawers" placeholder="{{ __('messages.mission') }}" name="mission[]" />

                                    <div style="margin-left: 10px;"></div> <!-- Add this div for spacing -->

                                    <input type="date" class="form-control form-control-solid other_lawers" placeholder="{{ __('messages.from') }}" name="date_from[]" />

                                    <div style="margin-left: 10px;"></div> <!-- Add this div for spacing -->

                                    <input type="date" class="form-control form-control-solid other_lawers" placeholder="{{ __('messages.to') }}" name="date_to[]" />

                                    <div style="margin-left: 10px;"></div> <!-- Add this div for spacing -->

                                    <input type="text" class="form-control form-control-solid other_lawers" placeholder="{{ __('messages.reason_leave') }}" name="reason_leave[]" />
                                </div>
                            </div>

                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.academic_qualification') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.academic_qualification') }}" name="academic"  id="academic" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.specialization') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.specialization') }}" name="specialization_academic"  id="specialization_academic" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.graduation_year') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.graduation_year') }}" name="year_academic"  id="year_academic" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.University_college') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.University_college') }}" name="college"  id="college" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.work_place') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.work_place') }}" name="work_place"  id="work_place" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.phone') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.phone') }}" name="phone"  id="phone" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.Job_title') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.Job_title') }}" name="Job_title"  id="Job_title" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.city') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select   aria-label="{{ __('messages.Select') }} {{ __('messages.city') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.city') }}"   class="form-select form-select-solid fw-bolder" id="city" name="city" onchange="SelectCity(this.value)" >
                                <option value="">اختر..</option>
                                <option value="1">عمان</option>
                                <option value="2">إربد</option>
                                <option value="3">الزرقاء</option>
                                <option value="4">العقبة</option>
                                <option value="5">مأدبا</option>
                                <option value="6">الكرك</option>
                                <option value="7">جرش</option>
                                <option value="8">عجلون</option>
                                <option value="9">المفرق</option>
                                <option value="10">الطفيلة</option>
                                <option value="11">معان</option>
                                <option value="12">البلقاء</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="selected_area">
                             <label class="required fs-6 fw-bold mb-2">{{ __('messages.area') }}</label>
                             <select  aria-label="{{ __('messages.Select') }} {{ __('messages.area') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.area') }}"   class="form-select form-select-solid fw-bolder" id="amman_region" name="amman_region" class="form-control">
                                <option value="">اختر..</option>
                                 <option value="أبو نصير">
                                    أبو نصير</option>

                                    <option value="شفا بدران">
                                    شفا بدران</option>

                                   <option value="الجبيهة">
                                    الجبيهة</option>

                                    <option value="طارق">
                                    طارق</option>

                                    <option value=" ماركا">
                                    ماركا</option>

                                    <option value="بسمان">
                                    بسمان</option>

                                    <option value="العبدلي">
                                    العبدلي</option>

                                    <option value="تلاع العلي وأم السماق وخلدا">
                                    تلاع العلي وأم السماق وخلدا</option>

                                    <option value="صويلح">
                                    صويلح</option>

                                    <option value="المدينة">
                                    المدينة</option>

                                    <option value="النصر">
                                    النصر</option>

                                    <option value="اليرموك">
                                    اليرموك</option>

                                    <option value="زهران">
                                    زهران</option>

                                    <option value="وادي السير">
                                    وادي السير</option>

                                    <option value="بدر الجديدة">
                                    بدر الجديدة</option>

                                    <option value="مرج الحمام">
                                    مرج الحمام</option>

                                    <option value="بدر">
                                    بدر</option>

                                    <option value="راس العين">
                                    راس العين</option>

                                    <option value="القويسمة وأبو علندا والجويدة و الرقيم">
                                    القويسمة وأبو علندا والجويدة و الرقيم </option>

                                    <option value="أم قصير ">
                                    أم قصير والمقابلين والبنيات</option>

                                    <option value="خريبة السوق">
                                    خريبة السوق وجاوا واليادودة</option>

                                    <option value="احد">
                                    احد </option>

                            </select>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="fv-row mb-7" id="text_area">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.area') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.area') }}" name="area"  id="area" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                       

                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.street_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.street_name') }}" name="street"  id="street" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.building_number') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.building_number') }}" name="building_number"  id="building_number" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.nearest_teacher') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.nearest_teacher') }}" name="nearest_teacher"  id="nearest_teacher" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                      


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.home_phone') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.home_phone') }}" name="home_phone"  id="home_phone" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                        <!--begin::Input group-->
                        <div class="fv-row mb-7">
                           
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.marital_status') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select  aria-label="{{ __('messages.Select') }} {{ __('messages.marital_status') }}" data-control="select2" data-placeholder="{{ __('messages.Select') }} {{ __('messages.marital_status') }}"   class="form-select form-select-solid fw-bolder" id="marital_status" name="marital_status" onchange="SelectCity(this.value)" >
                                <option value="">اختر..</option>
                                <option value="اعزب">اعزب</option>
                                <option value="متزوج">متزوج</option>
                                <option value="مطلق">مطلق</option>
                                
                            </select>
                            <!--end::Input-->
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.phone_comunication') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.phone_comunication') }}" name="phone_comunication"  id="phone_comunication" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.email') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.email') }}" name="email"  id="email" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.fax') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.fax') }}" name="fax"  id="fax" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.mailbox') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.mailbox') }}" name="mailbox"  id="mailbox" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.city') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.city') }}" name="city_comunication"  id="city_comunication" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->


                         <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class=" fs-6 fw-bold mb-2">{{ __('messages.zip_code') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.zip_code') }}" name="zip_code"  id="zip_code" />
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


