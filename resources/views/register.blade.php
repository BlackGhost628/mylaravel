<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ثبت‌نام | FoodEase</title>
  <link rel="stylesheet" href="../css/style.css">
</head>

<body class="light">

<header class="site-header">
  <div class="logo">
    <img src="../image/logo.png" alt="FoodEase Logo">
  </div>

  <nav class="main-menu">
    <ul>
      <li><a href="index.html">صفحه اصلی</a></li>
      <li><a href="products.html">منوی غذا</a></li>
      <li><a href="cart.html">سبد خرید</a></li>
      <li><a href="about.html">درباره ما</a></li>
      <li><a href="contact.html">تماس با ما</a></li>
    </ul>
  </nav>

  <!-- دکمه تغییر تم -->
  <button id="themeToggle" class="md-icon-btn theme-toggle" aria-label="تغییر تم">
    ☀️
  </button>
</header>

<main>
  <section class="md-card md-card-elevated md-card-enabled register-card">

    <h2 class="register-title">ثبت‌نام در FoodEase</h2>

    <form id="registerForm" action="index.html" method="post">

      <label for="fullname">نام و نام خانوادگی</label>
      <input type="text" id="fullname" placeholder="مثلاً علی رضایی" required>

      <label for="email">ایمیل</label>
      <input type="email" id="email" placeholder="example@email.com" required>

      <label for="password">رمز عبور</label>
      <input type="password" id="password" placeholder="حداقل ۸ کاراکتر" required>

      <label for="confirmPassword">تکرار رمز عبور</label>
      <input type="password" id="confirmPassword" required>

      <!-- قوانین -->
      <div class="md-card md-card-outlined" style="margin-top:20px;font-size:14px;line-height:1.9;">
        <strong>قوانین و شرایط استفاده</strong>
        <ul style="padding-right:18px;margin-top:10px;">
          <li>اطلاعات حساب کاربری باید صحیح و متعلق به خود شما باشد.</li>
          <li>مسئولیت حفظ امنیت رمز عبور بر عهده کاربر است.</li>
          <li>سفارش‌های ثبت‌شده پس از تأیید قابل لغو نیستند.</li>
          <li>FoodEase متعهد به حفظ حریم خصوصی کاربران است.</li>
        </ul>
      </div>

      <div style="margin-top:16px;">
        <input type="checkbox" id="terms">
        <label for="terms">قوانین و شرایط سایت را می‌پذیرم</label>
      </div>

     <div style="text-align:center;margin-top:24px;">
        <button id="registerBtn"
                type="submit"
                class="md-btn md-filled md-lg md-round md-disabled"
                style="color:#ffffff;"
                disabled>
          تکمیل ثبت‌نام
        </button>
      </div>

      <p style="text-align:center;margin-top:12px;font-size:14px;">
        قبلاً حساب دارید؟
        <a id="loginLink"
           href="login.html"
           class="md-btn md-text md-sm"
           style="color:#ff0000;">
          ورود
        </a>
      </p>

    </form>
  </section>
</main>

<footer>
  © 2025 FoodEase
</footer>

<!-- فایل‌های JS خارجی -->
<script src="../js/register.js"></script>
<script src="../js/theme.js"></script>

</body>
</html>
