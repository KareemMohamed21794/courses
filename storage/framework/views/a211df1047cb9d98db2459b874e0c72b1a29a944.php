<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>منصة الكورسات - تسجيل الدخول</title>
  <link rel="shortcut icon" href="<?php echo e(asset('login_page_design/favicon.svg')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('login_page_design/style.css')); ?>">
</head>

<body class="login-body">
  <div class="main_login">
    <div class="login-left-side">
      <h2>أهلاً بكم في</h2>
      <div class="login-brand">
        <span class="brand-name">منصة الكورسات</span>
        <span class="brand-name-en">Course Platform</span>
      </div>
      <h3>لوحة تحكم إدارة الكورسات والمشتركين</h3>
      <h2>
        أدر الكورسات و<span class="number-in-title">طلبات الشراء</span> بسهولة
      </h2>
      <div class="vector-div">
        <svg class="login-illustration" viewBox="0 0 400 280" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <rect x="60" y="40" width="280" height="180" rx="16" fill="rgba(255,255,255,0.12)"/>
          <rect x="80" y="60" width="120" height="8" rx="4" fill="rgba(255,255,255,0.5)"/>
          <rect x="80" y="80" width="200" height="6" rx="3" fill="rgba(255,255,255,0.3)"/>
          <rect x="80" y="96" width="180" height="6" rx="3" fill="rgba(255,255,255,0.3)"/>
          <rect x="80" y="112" width="160" height="6" rx="3" fill="rgba(255,255,255,0.3)"/>
          <rect x="80" y="140" width="90" height="32" rx="8" fill="#4361ee"/>
          <rect x="180" y="140" width="90" height="32" rx="8" fill="rgba(255,255,255,0.2)"/>
          <circle cx="300" cy="80" r="36" fill="rgba(255,255,255,0.15)"/>
          <path d="M285 80 L300 65 L315 80 L300 95 Z" fill="#fbbf24"/>
          <rect x="30" y="200" width="60" height="70" rx="8" fill="rgba(255,255,255,0.1)" transform="rotate(-12 60 235)"/>
          <rect x="310" y="190" width="60" height="70" rx="8" fill="rgba(255,255,255,0.1)" transform="rotate(8 340 225)"/>
        </svg>
      </div>
    </div>

    <div class="login-right-side">
      <div class="login-right-side-top-items">
        <div class="right-side-logo">
          <div class="logo-icon">
            <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <rect width="48" height="48" rx="12" fill="#4361ee"/>
              <path d="M14 16h20v4H14v-4zm0 8h20v4H14v-4zm0 8h14v4H14v-4z" fill="#fff"/>
              <circle cx="36" cy="32" r="8" fill="#fbbf24"/>
              <path d="M33 32l2 2 4-4" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
          </div>
          <span class="logo-text">منصة الكورسات</span>
        </div>

        <div class="login-form">
          <h4 class="login-form-title">تسجيل الدخول</h4>
          <form id="kt_sign_in_form" method="POST" action="<?php echo e(route('admin_login')); ?>">
            <?php echo csrf_field(); ?>

            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.auth-validation-errors','data' => ['class' => 'mb-4','errors' => $errors]]); ?>
<?php $component->withName('auth-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4','errors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

            <div class="login-form-input">
              <label for="username">اسم المستخدم</label>
              <input id="username" type="text" name="username" required autofocus value="<?php echo e(old('username')); ?>">
            </div>
            <div class="login-form-input">
              <label for="password">كلمة المرور</label>
              <input id="password" type="password" name="password" required autocomplete="current-password">
            </div>
            <div class="login-form-checkbox">
              <input id="remember_me" type="checkbox" name="remember">
              <label for="remember_me">تذكرني</label>
            </div>
            <div>
              <button class="login-form-submit-button" type="submit">تسجيل الدخول</button>
            </div>
            <div class="login-form-note">
              <p>في حال وجود أي مشكلة في الدخول<br>يرجى التواصل مع مدير النظام</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
<?php /**PATH E:\xampp\htdocs\courses\resources\views/auth/admin/login.blade.php ENDPATH**/ ?>