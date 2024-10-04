@extends('auth.admin.include.master')
@section('title', $title)
@section('content')
<style type="text/css">
    .select2-container--open .select2-dropdown{
        right: -794px;
    }

    @media only screen and (max-width: 600px) {
  .select2-container--open .select2-dropdown{
        right: -305px;
    }
}
</style>
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            
            <!--begin::Basic info-->
            <div class="card mb-5 mb-xl-10">
                <!--begin::Card header-->
                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                    <!--begin::Card title-->
                    <div class="card-title m-0">
                        <h3 class="fw-bolder m-0">{{ $title }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Content-->
                <div id="kt_account_profile_details" class="collapse show">
                    <!--begin::Form-->
                    
                     <form id="kt_account_profile_details_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" method="get" action="{{ url('admin/report_archive_secondary_registrations_get') }}" enctype="multipart/form-data">
                       

                        <!--begin::Card body-->
                        <div class="card-body border-top p-9">
 
  

                            <!--begin::Input group-->
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label fw-bold fs-6">اختر  السنة  </label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row">
                                     <select class="form-select form-select-solid fw-bolder" data-kt-select2="true" data-placeholder="اختر  السنة  " data-allow-clear="true" data-kt-branch-table-filter="active" data-dropdown-parent="#kt_account_profile_details" id="year" name="year" required>
                                        <option value="">اختر  السنة  </option>
                                        <?php
                                            for($i = date("Y")-3; $i < date("Y")+100; $i++){

                                            echo "<option>" . $i . "</option>";
                                                
                                            }
                                        ?>
                                    </select>
                                
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->

        <input type="hidden" name="type" id="type" value="administrative_archive">


                        </div>
                        <!--end::Card body-->
                        <!--begin::Actions-->
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                             
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{ __('messages.search') }}</button>
                        </div>
                        <!--end::Actions-->
                    </form>
                    <!--end::Form-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Basic info-->
 


            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->

@endsection

   

