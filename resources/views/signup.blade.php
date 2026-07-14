<!DOCTYPE html>
<html lang="fa">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ثبت‌نام - FoodEase</title>
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
</header>

<main>
  <div class="md-card md-card-elevated" style="max-width:420px;margin:40px auto;padding:30px;">
    <h2 style="text-align:center;">ثبت‌نام در FoodEase</h2>

    <form action="otp.html">
      <label>نام کامل</label>
      <input type="text" required>

      <label>ایمیل</label>
      <input type="email" required>

      <label>شماره تلفن</label>
      <input type="tel" required>

      <label>رمز عبور</label>
      <input type="password" required minlength="8">

      <label>تکرار رمز عبور</label>
      <input type="password" required>

      <label class="checkbox">
        <input type="checkbox" required> قوانین را می‌پذیرم
      </label>

      <div style="text-align:center;margin-top:16px;">
        <button class="md-btn md-filled md-md">ثبت‌نام</button>
      </div>

      <p style="text-align:center;font-size:14px;">
        حساب دارید؟
        <a href="login.html" class="md-btn md-text md-sm">ورود</a>
      </p>
    </form>
  </div>
</main>

<footer class="site-footer">© 2025 FoodEase</footer>
</body>
</html>
