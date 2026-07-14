<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ورود | FoodEase</title>
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
  <section class="md-card md-card-elevated md-card-enabled login-card">

    <h2 class="login-title">ورود به FoodEase</h2>

    <form action="index.html" method="post" class="login-form">

      <div class="form-group">
        <label for="email">ایمیل</label>
        <input
          id="email"
          name="email"
          type="email"
          placeholder="example@email.com"
          required
          autocomplete="email"
          class="md-textfield"
        >
      </div>

      <div class="form-group">
        <label for="password">رمز عبور</label>
        <input
          id="password"
          name="password"
          type="password"
          placeholder="••••••••"
          required
          autocomplete="current-password"
          class="md-textfield"
        >
      </div>
      <br>
      <div class="login-action">
        <button type="submit" class="md-btn md-filled md-lg md-round login-btn">
          ورود
        </button>
      </div>

      <div class="login-link">
        رمز خود را فراموش کردید؟
        <a href="forgot.html" class="md-btn md-text md-sm">
          فراموشی رمز عبور
        </a>
      </div>

      <p class="login-register">
        حساب ندارید؟
        <a href="register.html" class="md-btn md-text md-sm">
          ثبت نام کنید
        </a>
      </p>

    </form>
  </section>
</main>

<footer>
  © 2025 FoodEase
</footer>

</body>
</html>
