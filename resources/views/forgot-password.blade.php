<!DOCTYPE html>
<html lang="fa">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>فراموشی رمز عبور | FoodEase</title>
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

    <h2 class="login-title">فراموشی رمز عبور</h2>

    <form action="otp.html" method="post" class="login-form">

      <div class="form-group">
        <label for="user-identity">ایمیل یا شماره موبایل</label>
        <input
          id="user-identity"
          name="identity"
          type="text"
          placeholder="example@email.com یا 09123456789"
          required
          autocomplete="username"
          class="md-textfield"
        >
      </div>
      <br>
      <div class="login-action">
        <button type="submit" class="md-btn md-filled md-md md-round">
          ارسال کد
        </button>
      </div>

      <p class="login-link">
        <a href="login.html" class="md-btn md-text md-sm">
          بازگشت به ورود
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
