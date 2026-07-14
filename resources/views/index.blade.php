<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FoodEase - صفحه اصلی</title>

  <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

  <style>
    /* ==========================
   Button Component
========================== */

.btn-component{
    display:inline-flex;
    align-items:center;
    gap:8px;

    padding:12px 20px;

    border-radius:10px;
    text-decoration:none;

    font-weight:bold;
    transition:0.3s;

    color:white;
}

.btn-component:hover{
    transform:translateY(-2px);
}

.btn-primary{
    background:#0d6efd;
}

.btn-success{
    background:#198754;
}

.btn-danger{
    background:#dc3545;
}

.btn-warning{
    background:#ffc107;
    color:black;
}

    .product-card .price {
      color: #000;
      font-weight: bold;
    }

    .like-btn {
      background: none;
      border: none;
      cursor: pointer;
      font-size: 1.5rem;
      color: #999;
      transition: color 0.2s, transform 0.2s;
      padding: 4px;
    }

    .like-btn.liked {
      color: #e74c3c;
      transform: scale(1.2);
    }

    .product-actions {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-top: 8px;
      flex-wrap: wrap;
    }

    .rating {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      user-select: none;
      direction: ltr;
    }

    .rating .star-btn {
      width: 36px;
      height: 36px;
      border: none;
      background: transparent;
      cursor: pointer;
    }

    .rating .star {
      width: 22px;
      height: 22px;
      fill: none;
      stroke: #bdbdbd;
      stroke-width: 1.6;
    }

    .rating .star-btn.filled .star {
      fill: #f1c40f;
      stroke: #f39c12;
    }

    .product-footer {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      flex-wrap: wrap;
      margin-top: 8px;
    }
  </style>
</head>

<body class="light">

<header class="site-header">
  <div class="logo">
    <img src="{{ asset('image/logo.png') }}" alt="FoodEase Logo" />
  </div>

  <nav class="main-menu">
    <ul>
      <li><a href="{{ url('/') }}" class="active">صفحه اصلی</a></li>
      <li><a href="{{ url('/products') }}">منوی غذا</a></li>
      <li><a href="{{ url('/cart') }}">سبد خرید</a></li>
      <li><a href="{{ url('/about') }}">درباره ما</a></li>
      <li><a href="{{ url('/team') }}">تیم ما</a></li>
      <li><a href="{{ url('/contact') }}">تماس با ما</a></li>
    </ul>
  </nav>

  <div id="themeToggle" class="md-btn md-tonal md-sm md-round">🌙</div>
</header>

<main>

</section>

  <section class="md-card md-card-filled" style="margin-bottom:40px;">
    <h2>به FoodEase خوش آمدید!</h2>
    <p>FoodEase بهترین تجربه سفارش آنلاین غذا را برای شما فراهم می‌کند.</p>
    <a href="{{ url('/products') }}" class="md-btn md-filled md-md md-round md-hover">
      مشاهده منو
    </a>
  </section>

  <section>
    <h2 style="text-align:center;">منوی نمونه</h2>

    <div class="product-grid">

      <!-- محصول ۱ --> <article class="md-card md-card-elevated md-card-hover product-card"> <img src="../image/pizza.jpg" alt="پیتزا مخصوص" /> <h3>پیتزا مخصوص</h3> <p>پیتزا با پنیر تازه و مواد ویژه</p> <span class="price">150,000 تومان</span> <!-- محل ستاره‌های امتیازدهی (پنج دکمه کنار هم) --> <div class="product-footer"> <div class="rating" data-rating="0" role="radiogroup" aria-label="امتیاز محصول: پیتزا مخصوص"> <button type="button" class="star-btn" data-value="1" aria-label="یک ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">1 ستاره</span> </button> <button type="button" class="star-btn" data-value="2" aria-label="دو ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">2 ستاره</span> </button> <button type="button" class="star-btn" data-value="3" aria-label="سه ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">3 ستاره</span> </button> <button type="button" class="star-btn" data-value="4" aria-label="چهار ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">4 ستاره</span> </button> <button type="button" class="star-btn" data-value="5" aria-label="پنج ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">5 ستاره</span> </button> </div> <div class="product-actions"> <a href="cart.html" class="md-btn md-filled md-sm md-round">افزودن به سبد</a> <button class="like-btn" data-liked="false" title="لایک">♡</button> </div> </div> </article> <!-- محصول ۲ --> <article class="md-card md-card-elevated md-card-hover product-card"> <img src="../image/kabbab.jpg" alt="کباب ایرانی" /> <h3>کباب ایرانی</h3> <p>گوشت تازه، برنج ایرانی</p> <span class="price">120,000 تومان</span> <div class="product-footer"> <div class="rating" data-rating="0" role="radiogroup" aria-label="امتیاز محصول: کباب ایرانی"> <button type="button" class="star-btn" data-value="1" aria-label="یک ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">1 ستاره</span> </button> <button type="button" class="star-btn" data-value="2" aria-label="دو ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">2 ستاره</span> </button> <button type="button" class="star-btn" data-value="3" aria-label="سه ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">3 ستاره</span> </button> <button type="button" class="star-btn" data-value="4" aria-label="چهار ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">4 ستاره</span> </button> <button type="button" class="star-btn" data-value="5" aria-label="پنج ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">5 ستاره</span> </button> </div> <div class="product-actions"> <a href="cart.html" class="md-btn md-filled md-sm md-round">افزودن به سبد</a> <button class="like-btn" data-liked="false" title="لایک">♡</button> </div> </div> </article> <!-- محصول ۳ --> <article class="md-card md-card-elevated md-card-hover product-card"> <img src="../image/salad.webp" alt="سالاد فصل" /> <h3>سالاد فصل</h3> <p>سبزیجات تازه و سالم</p> <span class="price">50,000 تومان</span> <div class="product-footer"> <div class="rating" data-rating="0" role="radiogroup" aria-label="امتیاز محصول: سالاد فصل"> <button type="button" class="star-btn" data-value="1" aria-label="یک ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">1 ستاره</span> </button> <button type="button" class="star-btn" data-value="2" aria-label="دو ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">2 ستاره</span> </button> <button type="button" class="star-btn" data-value="3" aria-label="سه ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">3 ستاره</span> </button> <button type="button" class="star-btn" data-value="4" aria-label="چهار ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">4 ستاره</span> </button> <button type="button" class="star-btn" data-value="5" aria-label="پنج ستاره" role="radio" aria-checked="false"> <svg class="star" viewBox="0 0 24 24" aria-hidden="true"> <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.62L12 2 9.19 8.62 2 9.24l5.46 4.73L5.82 21z"/> </svg> <span class="sr-only">5 ستاره</span> </button> </div>
    <div class="product-actions"> <a href="cart.html" class="md-btn md-filled md-sm md-round">افزودن به سبد</a> <button class="like-btn" data-liked="false" title="لایک">♡</button> </div> </div> </article>
    </div>
  </section>

</main>

<footer class="site-footer">
  <div class="footer-info">
    <p>© 2025 FoodEase</p>
    <p>ایران، اصفهان - تلفن: 031-35289966</p>
  </div>
</footer>

<script src="{{ asset('js/theme.js') }}"></script>
<script src="{{ asset('js/like.js') }}"></script>
<script src="{{ asset('js/rating.js') }}"></script>

</body>
</html>