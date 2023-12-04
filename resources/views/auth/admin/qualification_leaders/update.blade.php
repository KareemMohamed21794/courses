
<!-- Include Bootstrap JS (jQuery is a prerequisite) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

 <style>
    /* Add custom styles for the accordion_update */
    #accordion_update .card {
        border: 1px solid #e0e0e0;
        margin-bottom: 10px;
    }

    #accordion_update .card-header {
        background-color: #f8f9fa;
        border: 1px solid #e0e0e0;
    }

    #accordion_update .card-header h5 {
        font-size: 18px;
    }

    #accordion_update .card-header button {
        color: #333;
        text-decoration: none;
        padding: 10px;
        width: 100%;
        text-align: left;
    }

    #accordion_update .card-header button:focus {
        outline: none;
    }

    #accordion_update .card-body {
        background-color: #fff;
        padding: 15px;
    }
</style>

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
                    <h2 class="fw-bolder">{{ __('messages.Update') }} {{$title}}</h2>
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

                        @if($objAdmin->is_super == 1)
                         <!--begin::Input group-->
                        <div class="d-flex flex-column mb-7 fv-row">
                            <!--begin::Label-->
                            <label class="fs-6 fw-bold mb-2">
                                <span class="required">{{ __('messages.scout_group') }}</span>
                            </label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select name="leader_id" id="leader_id_update" aria-label="{{ __('messages.Select') }} {{ __('messages.scout_group') }}"   data-placeholder="{{ __('messages.Select') }} {{ __('messages.scout_group') }}" data-dropdown-parent="#kt_modal_update" class="form-select form-select-solid fw-bolder">
                                <option value="">{{ __('messages.scout_group') }}</option >
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
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.leader_name') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.leader_name') }}" name="leader_name"  id="leader_name_update" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->



                           <!--begin::Input group-->
                        <div class="fv-row mb-7">
                            <!--begin::Label-->
                            <label class="required fs-6 fw-bold mb-2">{{ __('messages.current_qualification') }}</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                           <select onchange="CurrentQualificationUpdate(this.value)" name="current_qualification" id="current_qualification_update" data-placeholder="{{ __('messages.current_qualification') }}" class="form-select form-select-solid">
                                <option value="">{{ __('messages.current_qualification') }}</option>
                                <option value="ghayr_muahal">غير مؤهل</option>
                                <option value="musaeid_qayid_wahdah">مساعد قائد وحدة</option>
                                <option value="qayid_wahda">"قائد وحدة "شارة خشبية </option>
                                <option value="musaeid_qayid_tadrib">مساعد قائد تدريب</option>
                                <option value="qayid_tadrib">قائد تدريب</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->
                     
                       <!-- BEGIN MAIN Section  -->
                        <div id="accordion_update">
                            <!-- Section 1 -->
                            <div class="card" id="card_update1">
                                <div class="card-header" id="headingOne_update" style="background-color:silver">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne_update" aria-expanded="true" aria-controls="collapseOne_update">
                                          مساعد قائد وحدة   
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseOne_update" class="collapse" aria-labelledby="headingOne_update" data-parent="#accordion_update" style="display: none;">
                                    <div class="card-body">
                                         <!--begin::group-->
                                       
                                       <!--end::group-->
                                    </div>
                                </div>
                                 <div id="musaeid_qayid_wahdah_update">

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.study_history_mqw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.study_history_mqw') }}" name="study_history_mqw"  id="study_history_mqw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.place_study_mqw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place_study_mqw') }}" name="place_study_mqw"  id="place_study_mqw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.organizer_mqw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.organizer_mqw') }}" name="organizer_mqw"  id="organizer_mqw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                             <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.rent_date_mqw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.rent_date_mqw') }}" name="rent_date_mqw"  id="rent_date_mqw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.rent_number_mqw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.rent_number_mqw') }}" name="rent_number_mqw"  id="rent_number_mqw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                          
                                        </div>
                            </div>

                            <!-- Section 2 -->
                            <div class="card" id="card_update2">
                                <div class="card-header" id="headingTwo_update" style="background-color:silver">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo_update" aria-expanded="false" aria-controls="collapseTwo_update">
                                        قائد وحدة شارة خشبية  
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseTwo_update" class="collapse" aria-labelledby="headingTwo_update" data-parent="#accordion_update" style="display: none;">
                                    <div class="card-body">
                                        <!--begin::group-->
                                        
                                       <!--end::group-->
                                    </div>
                                </div>
                                <div id="qayid_wahda_update">

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.study_history_qw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.study_history_qw') }}" name="study_history_qw"  id="study_history_qw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.place_study_qw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place_study_qw') }}" name="place_study_qw"  id="place_study_qw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.organizer_qw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.organizer_qw') }}" name="organizer_qw"  id="organizer_qw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                             <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.rent_date_qw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.rent_date_qw') }}" name="rent_date_qw"  id="rent_date_qw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.rent_number_qw') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.rent_number_qw') }}" name="rent_number_qw"  id="rent_number_qw_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                          
                                        </div>
                            </div>

                            <!-- Section 3 -->
                            <div class="card" id="card_update3">
                                <div class="card-header" id="headingThree_update" style="background-color:silver">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree_update" aria-expanded="false" aria-controls="collapseThree_update">
                                        مساعد قائد تدريب
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseThree_update" class="collapse" aria-labelledby="headingThree_update" data-parent="#accordion_update" style="display: none;">
                                    <div class="card-body">
                                        <!--begin::group-->
                                        
                                       <!--end::group-->
                                    </div>
                                </div>

                                <div id="musaeid_qayid_tadrib_update">

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.study_history_mqt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.study_history_mqt') }}" name="study_history_mqt"  id="study_history_mqt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.place_study_mqt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place_study_mqt') }}" name="place_study_mqt"  id="place_study_mqt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.organizer_mqt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.organizer_mqt') }}" name="organizer_mqt"  id="organizer_mqt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                             <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.rent_date_mqt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.rent_date_mqt') }}" name="rent_date_mqt"  id="rent_date_mqt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class=" fs-6 fw-bold mb-2">{{ __('messages.rent_number_mqt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.rent_number_mqt') }}" name="rent_number_mqt"  id="rent_number_mqt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                          
                                        </div>
                            </div>

                            <!-- Section 4 -->
                            <div class="card" id="card_update4">
                                <div class="card-header" id="headingFour_update" style="background-color:silver">
                                    <h5 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour_update" aria-expanded="false" aria-controls="collapseFour_update">
                                        قائد تدريب
                                        </button>
                                    </h5>
                                </div>
                                <div id="collapseFour_update" class="collapse" aria-labelledby="headingFour_update" data-parent="#accordion_update" style="display: none;">
                                    <div class="card-body">
                                         <!--begin::group-->
                                      
                                       <!--end::group-->
                                    </div>
                                </div>
                                  <div id="qayid_tadrib_update">

                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.study_history_qt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.study_history_qt') }}" name="study_history_qt"  id="study_history_qt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.place_study_qt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.place_study_qt') }}" name="place_study_qt"  id="place_study_qt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->



                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.organizer_qt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.organizer_qt') }}" name="organizer_qt"  id="organizer_qt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                             <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.rent_date_qt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="date" class="form-control form-control-solid" placeholder="{{ __('messages.rent_date_qt') }}" name="rent_date_qt"  id="rent_date_qt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Input group-->
                                            <div class="fv-row mb-7" >
                                                <!--begin::Label-->
                                                <label class="required fs-6 fw-bold mb-2">{{ __('messages.rent_number_qt') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" class="form-control form-control-solid" placeholder="{{ __('messages.rent_number_qt') }}" name="rent_number_qt"  id="rent_number_qt_update" />
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Input group-->
                                          
                                        </div>
                            </div>
                        </div>
                         <!-- END  MAIN Section  -->
                         
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
