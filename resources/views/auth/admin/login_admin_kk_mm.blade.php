<!DOCTYPE html>
<html lang="ar" data-arp-injected="true">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <base href=".">
  <title>نظام تواصل - تسجيل الدخول</title>
  <link rel="shortcut icon" href="https://tawasol.privatescouts.org/public/login_page_design/assets/logo.png">
  <link rel="stylesheet" href="https://tawasol.privatescouts.org/public/login_page_design/assets/style.css">
</head>

<body id="kt_body" class="bg-body login-body" data-new-gr-c-s-check-loaded="14.1135.0" data-gr-ext-installed=""
  cz-shortcut-listen="true">
  <div class="main_login">
    <div class="login-left-side">
      <h2>
        أهلاً بكم في نظام
      </h2>
      <div class="login-logo">
        <img src="https://tawasol.privatescouts.org/public/login_page_design/assets/Asset-2.png" />
      </div>
      <h3>لتسهيل المراسلات بين القطاع والمجموعات</h3>
      <h2>
        نتواصل مع <span class="number-in-title">70+</span> مجموعة كشفية وإرشادية
      </h2>
      <div class="vector-div">
        <img src="https://tawasol.privatescouts.org/public/login_page_design/assets/Asset-3.png" />
      </div>
    </div>

    <div class="login-right-side">
      <div class="login-right-side-top-items">
        <div class="right-side-logo">
          <img src="https://tawasol.privatescouts.org/public/login_page_design/assets/logo.png">
        </div>

        <div class="login-form">
          <form class=""  id="kt_sign_in_form" method="POST" action="{{ route('admin_login') }}"> 
            @csrf
            <div class="login-form-input">
          

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
              <label>اسم المستخدم باللغة الانجليزية فقط</label>
              <input id="username" type="username" name="username" required="required" autofocus="autofocus">
            </div>
            <div class="login-form-input">
              <label>كلمة المرور</label>
              <input id="password" type="password" name="password" required="required" autocomplete="current-password">
            </div>
            <div class="login-form-checkbox">
              <input id="remember_me" type="checkbox" name="remember">
              <label>تذكرني</label>
            </div>
            <div>
              <button class="login-form-submit-button" type="submit" id="kt_sign_in_submit_">تسجيل الدخول</button>
            </div>
            <div class="login-form-note">
              <p>في حال وجود أي مشكلة في الدخول<br />يرجى التواصل مع مع سكرتير القطاع مباشرة</p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>

</html>