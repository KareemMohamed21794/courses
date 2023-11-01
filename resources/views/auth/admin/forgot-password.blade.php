<!DOCTYPE html>
<html lang="en">
    <!--begin::Head-->
    <head><base href="../../../">
        <title>Admin Login : Account SYSTEM</title>
        <meta charset="utf-8" />
        <link rel="shortcut icon" href="https://tawasol.privatescouts.org/public/images/logo.png" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ asset('demo1/dist/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('demo1/dist/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="bg-body">
        <!--begin::Main-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Authentication - Sign-in -->
            <div class="d-flex flex-column flex-lg-row flex-column-fluid">
                <!--begin::Aside-->
                <div class="d-flex flex-column flex-lg-row-auto w-xl-600px positon-xl-relative" style="background-color: #F2C98A">
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column position-xl-fixed top-0 bottom-0 w-xl-600px scroll-y">
                        <!--begin::Content-->
                        <div class="d-flex flex-row-fluid flex-column text-center p-10 pt-lg-20">
                            <!--begin::Logo-->
                            <a href="" class="py-9 mb-5">
                                <img alt="Logo" src="{{ asset('public/images/logo.png'); }}" class="h-90px" />
                                 
                            </a>
                            <!--end::Logo-->
                            <!--begin::Title-->
                            <h1 class="fw-bolder fs-2qx pb-5 pb-md-10" style="color: #986923;">Welcome to Account System</h1>
                            <!--end::Title-->
                            <!--begin::Description-->
                            <p class="fw-bold fs-2" style="color: #986923;">Discover Amazing Account System
                            <br />with great Control tools</p>
                            <!--end::Description-->
                        </div>
                        <!--end::Content-->
                        <!--begin::Illustration-->
                        <div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-100px min-h-lg-350px" style="background-image: url({{ asset('demo1/dist/assets/media/illustrations/sketchy-1/13.png') }}"></div>
                        <!--end::Illustration-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Aside-->
                <!--begin::Body-->
                <div class="d-flex flex-column flex-lg-row-fluid py-10">
                    <!--begin::Content-->
                    <div class="d-flex flex-center flex-column flex-column-fluid">
                        <!--begin::Wrapper-->
                        <div class="w-lg-500px p-10 p-lg-15 mx-auto">
                            <!--begin::Form-->

                            



                            <form class=""  id="kt_sign_in_form" method="POST" action="{{ route('admin_password.email') }}"> 

                                
                                @csrf
                                <!--begin::Heading-->
                                <div class="text-center mb-10">
                                    <!--begin::Title-->
                                    <h3 class="text-dark mb-3">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</h3>
                                    <!--end::Title-->
                                </div>

                                <!-- Session Status -->
                                <x-auth-session-status class="mb-4" :status="session('status')" />

                                <!-- Validation Errors -->
                                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                                <!--begin::Heading-->
                                <!--begin::Input group-->
                                <div class="fv-row mb-10">
                                    <!--begin::Label-->
                                    <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                                    <!--end::Label-->
                                    <!--begin::Input-->
                                    <x-input id="email" class="form-control form-control-lg form-control-solid" type="email" name="email" :value="old('email')" required autofocus />
                                    <!--end::Input-->
                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="text-center">
                                    <!--begin::Submit button-->
                                    <button type="submit" id="kt_sign_in_submit_" class="btn btn-lg btn-primary w-100 mb-5">
                                        <span class="indicator-label">Continue</span>
                                        <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Submit button-->
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Content-->
                    <!--begin::Footer-->
                    <div class="d-flex flex-center flex-wrap fs-6 p-5 pb-0">
                        <!--begin::Links-->
                        <div class="d-flex flex-center fw-bold fs-6">
                            <a href="https://www.facebook.com/mahmoud.ali.12979/" class="text-muted text-hover-primary px-2" target="_blank">About</a>
                            <a href="mailto:mahmoud.ali.29992@gmail.com" class="text-muted text-hover-primary px-2" target="_blank">Support</a>
                            <a href="tel:+201096615770" class="text-muted text-hover-primary px-2" target="_blank">Purchase</a>
                        </div>
                        <!--end::Links-->
                    </div>
                    <!--end::Footer-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Authentication - Sign-in-->
        </div>
        <!--end::Main-->
        <script>var hostUrl = "assets/";</script>
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->
        <script src="{{ asset('demo1/dist/assets/plugins/global/plugins.bundle.js') }}"></script>
        <script src="{{ asset('demo1/dist/assets/js/scripts.bundle.js') }}"></script>
        <!--end::Global Javascript Bundle-->
        <!--begin::Page Custom Javascript(used by this page)-->
        {{-- <script src="{{ asset('demo1/dist/assets/js/custom/authentication/sign-in/general.js') }}"></script> --}}
        <!--end::Page Custom Javascript-->
        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>

{{-- <script type="text/javascript">
    "use strict";var KTSigninGeneral=function(){var t,e,i;return{init:function(){t=document.querySelector("#kt_sign_in_form"),e=document.querySelector("#kt_sign_in_submit"),i=FormValidation.formValidation(t,{fields:{email:{validators:{notEmpty:{message:"Email address is required"},emailAddress:{message:"The value is not a valid email address"}}},password:{validators:{notEmpty:{message:"The password is required"}}}},plugins:{trigger:new FormValidation.plugins.Trigger,bootstrap:new FormValidation.plugins.Bootstrap5({rowSelector:".fv-row"})}}),e.addEventListener("click",(function(n){n.preventDefault(),i.validate().then((function(i){"Valid"==i?(e.setAttribute("data-kt-indicator","on"),e.disabled=!0,setTimeout((function(){e.removeAttribute("data-kt-indicator"),e.disabled=!1,Swal.fire({text:"You have successfully logged in!",icon:"success",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}}).then((function(e){e.isConfirmed&&(t.querySelector('[name="email"]').value="",t.querySelector('[name="password"]').value="")}))}),2e3)):Swal.fire({text:"Sorry, looks like there are some errors detected, please try again.",icon:"error",buttonsStyling:!1,confirmButtonText:"Ok, got it!",customClass:{confirmButton:"btn btn-primary"}})}))}))}}}();KTUtil.onDOMContentLoaded((function(){KTSigninGeneral.init()}));
</script> --}}

