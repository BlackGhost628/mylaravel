<header class="site-header">
  <div class="logo">
    <img src="{{ asset('image/logo.png') }}" alt="FoodEase Logo" />
  </div>

  <nav class="main-menu">
    <ul>
            <li><a href="{{ route('home') }}">خانه</a></li>
            <li><a href="{{ route('products') }}">منوی غذا</a></li>
            <li>
    <a href="{{ route('cart') }}" @if(Route::is('cart')) class="active" @endif>
        🛒 سبد خرید
        @if($cartCount > 0)
            <span class="cart-badge">{{ $cartCount }}</span>
        @endif
    </a>
</li>
            <li><a href="{{ route('about') }}">درباره ما</a></li>
            <li><a href="{{ route('team') }}">تیم ما</a></li>
            <li><a href="{{ route('contact') }}">تماس با ما</a></li>
    </ul>
  </nav>

  <div id="themeToggle" class="md-btn md-tonal md-sm md-round">🌙</div>
  </header>

