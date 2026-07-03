<!DOCTYPE html>
<?php if(App::isLocale('en')): ?>
<html lang="en">
<?php elseif(App::isLocale('ar')): ?>
<html lang="ar" direction="rtl" dir="rtl" style="direction: rtl">
<?php endif; ?>
<input type="hidden" name="action_lang" id="action_lang" value="<?php echo e(__('messages.Actions')); ?>">
<input type="hidden" name="edit_lang" id="edit_lang" value="<?php echo e(__('messages.edit')); ?>">
<input type="hidden" name="delete_lang" id="delete_lang" value="<?php echo e(__('messages.delete')); ?>">
<input type="hidden" name="profile_lang" id="profile_lang" value="<?php echo e(__('messages.staff_profile')); ?>">
<input type="hidden" name="show_lang" id="show_lang" value="<?php echo e(__('messages.show')); ?>">
<input type="hidden" name="show" id="show" value="<?php echo e(__('messages.show')); ?>">
<input type="hidden" name="delete_confirmation" id="delete_confirmation" value="<?php echo e(__('messages.delete_confirmation')); ?>">
<input type="hidden" name="yes_delete" id="yes_delete" value="<?php echo e(__('messages.yes_delete')); ?>">
<input type="hidden" name="no_delete" id="no_delete" value="<?php echo e(__('messages.no_delete')); ?>">

<input type="hidden" name="sucessful_add" id="sucessful_add" value="<?php echo e(__('messages.sucessful_add')); ?>">


<input type="hidden" name="sucessful_edit" id="sucessful_edit" value="<?php echo e(__('messages.sucessful_edit')); ?>">

<input type="hidden" name="base_url" id="base_url" value="<?php echo e(url('')); ?>">


<?php if(Auth::guard('admin')->check()): ?>
<input type="hidden" name="guard" id="guard" value="admin">
    <?php if(Auth::user()->is_super): ?>
        <input type="hidden" name="guard_type" id="guard_type" value="1">
    <?php else: ?>
        <input type="hidden" name="guard_type" id="guard_type" value="0">
    <?php endif; ?>
<?php endif; ?>

<style type="text/css">
    @media  only screen and (max-width: 600px) {
  .select2-container--open .select2-dropdown{
        right: -130px !important;
    }
}
</style>

    <!--begin::Head-->
    <head><base href="">
        <title><?php echo $__env->yieldContent('title'); ?></title>
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta property="og:locale" content="en_US" />
        <meta property="og:type" content="article" />
        <meta property="og:title" content="Account system" />
        <meta property="og:url" content="https://www.facebook.com/mahmoud.ali.12979/" />
        <meta property="og:site_name" content="Software" />
        <link rel="shortcut icon" href="" />
        <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->

        <?php if(Request::segment(2)=='' || Request::segment(2)=='dashboard'): ?>
        <!--begin::Page Vendor Stylesheets(used by this page)-->
        <link href="<?php echo e(asset('demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <?php endif; ?>

        <?php if(Request::segment(2)=='admins' || Request::segment(2)=='courses' || Request::segment(2)=='payments' || Request::segment(2)=='users' || Request::segment(2)=='secondary_registrations' || Request::segment(2)=='administrative_financial_reports' || Request::segment(2)=='leaders'|| Request::segment(2)=='board_director_meetings'|| Request::segment(2)=='permits'|| Request::segment(2)=='qualification_leaders' ): ?>
            <!--begin::Page Vendor Stylesheets(used by this page)-->
            <link href="<?php echo e(asset('demo1/dist/assets/plugins/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
            <!--end::Page Vendor Stylesheets-->
        <?php endif; ?>


        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <?php if(App::isLocale('en')): ?>
            <?php if(empty(session('darkmode'))): ?>
                <link href="<?php echo e(asset('demo1/dist/assets/plugins/global/plugins.bundle.css')); ?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo e(asset('demo1/dist/assets/css/style.bundle.css')); ?>" rel="stylesheet" type="text/css" />
            <?php else: ?>
                <link href="<?php echo e(asset('demo1/dist/assets/plugins/global/plugins.dark.bundle.css')); ?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo e(asset('demo1/dist/assets/css/style.dark.bundle.css')); ?>" rel="stylesheet" type="text/css" />
            <?php endif; ?>

        <?php elseif(App::isLocale('ar')): ?>
            <?php if(empty(session('darkmode'))): ?>
                <link href="<?php echo e(asset('demo1/dist/assets/plugins/global/plugins.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo e(asset('demo1/dist/assets/css/style.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
            <?php else: ?>
                <link href="<?php echo e(asset('demo1/dist/assets/plugins/global/plugins.dark.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
                <link href="<?php echo e(asset('demo1/dist/assets/css/style.dark.bundle.rtl.css')); ?>" rel="stylesheet" type="text/css" />
            <?php endif; ?>
        <?php endif; ?>
        <!--end::Global Stylesheets Bundle-->
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="dark-mode header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
        <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">
                <?php echo $__env->make('auth.admin.include.aside_menu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <!--begin::Wrapper-->
                <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                    <?php echo $__env->make('auth.admin.include.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <!--begin::Content-->
                    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                        <?php echo $__env->make('auth.admin.include.toolbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->yieldContent('content'); ?>
                    </div>
                    <!--end::Content-->
                    <?php echo $__env->make('auth.admin.include.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->

        <!--begin::Drawers-->
        <?php echo $__env->make('auth.admin.include.activities_drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('auth.admin.include.chat_drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php echo $__env->make('auth.admin.include.exolore_drawer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <!--end::Drawers-->

        <!--begin::Scrolltop-->
        <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
            <span class="svg-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black" />
                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Scrolltop-->
        <!--end::Main-->
        <script>var hostUrl = "assets/";</script>
        <!--begin::Javascript-->
        <!--begin::Global Javascript Bundle(used by all pages)-->

        <script src="<?php echo e(asset('demo1/dist/assets/plugins/global/axios.min.js')); ?>"></script>
        <script src="<?php echo e(asset('demo1/dist/assets/plugins/global/plugins.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('demo1/dist/assets/js/scripts.bundle.js')); ?>"></script>
        <script src="<?php echo e(asset('js/admin.js')); ?>"></script>
        <!--end::Global Javascript Bundle-->

        <?php if(Request::segment(2)=='' || Request::segment(2)=='dashboard'): ?>
        <!--begin::Page Vendors Javascript(used by this page)-->
        <script src="<?php echo e(asset('demo1/dist/assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')); ?>"></script>
        <!--end::Page Vendors Javascript-->
        <?php endif; ?>
        <!--begin::Page Custom Javascript(used by this page)-->
        <script src="<?php echo e(asset('demo1/src/js/custom/widgets.js')); ?>"></script>
        <!--end::Page Custom Javascript-->


        <?php echo $__env->yieldContent('scripts'); ?>





        <!--end::Javascript-->
    </body>
    <!--end::Body-->
</html>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/auth/admin/include/master.blade.php ENDPATH**/ ?>