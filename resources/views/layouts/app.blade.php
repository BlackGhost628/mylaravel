<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- متاتگ‌های پیش‌فرض --}}
@php
    $defaultTitle = 'FoodEase - سفارش آنلاین غذا';
    $defaultDescription = 'سفارش آنلاین غذاهای ایرانی و فست‌فود با بهترین قیمت و کیفیت';
    $defaultKeywords = 'سفارش غذا, آنلاین, پیتزا, کباب, برگر, سوشی';
    $defaultImage = asset('image/logo.png');
@endphp

<title>@yield('title', $defaultTitle)</title>
<meta name="description" content="@yield('description', $defaultDescription)">
<meta name="keywords" content="@yield('keywords', $defaultKeywords)">
<meta property="og:title" content="@yield('og_title', $defaultTitle)">
<meta property="og:description" content="@yield('og_description', $defaultDescription)">
<meta property="og:image" content="@yield('og_image', $defaultImage)">
<meta property="og:url" content="{{ url()->current() }}">
<meta name="twitter:card" content="summary_large_image">
<link rel="canonical" href="{{ url()->current() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="light">
    <header class="site-header">
        <div class="logo">
            <img src="{{ asset('image/logo.png') }}" alt="FoodEase Logo" />
        </div>

        <nav class="main-menu">
            <ul>
                <li><a href="{{ route('home') }}" @if(Route::is('home')) class="active" @endif>صفحه اصلی</a></li>
                <li><a href="{{ route('products') }}" @if(Route::is('products')) class="active" @endif>منوی غذا</a></li>
                <li>
                    <a href="{{ route('cart') }}" @if(Route::is('cart')) class="active" @endif>
                        🛒 سبد خرید
                        @php
                            $cartCount = 0;
                            $cart = Session::get('cart', []);
                            foreach ($cart as $item) {
                                $cartCount += $item['quantity'];
                            }
                        @endphp
                        @if($cartCount > 0)
                            <span class="cart-badge">{{ $cartCount }}</span>
                        @endif
                    </a>
                </li>
                <li><a href="{{ route('about') }}" @if(Route::is('about')) class="active" @endif>درباره ما</a></li>
                <li><a href="{{ route('team') }}" @if(Route::is('team')) class="active" @endif>تیم ما</a></li>
                <li><a href="{{ route('contact') }}" @if(Route::is('contact')) class="active" @endif>تماس با ما</a></li>
            </ul>
        </nav>

        <div style="display:flex;align-items:center;gap:10px;">
            @auth
                <div class="user-menu">
                    <button class="dropdown-toggle" onclick="toggleDropdown()">👤</button>
                    <div class="dropdown-menu" id="userDropdown">
                        <div class="user-info">
                            <strong>{{ Auth::user()->name }}</strong>
                            <small>{{ Auth::user()->email }}</small>
                        </div>
                        
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}">⚙️ پنل مدیریت</a>
                        @endif
                        
                        <a href="{{ route('profile.edit') }}">👤 پروفایل</a>
                        <a href="{{ route('orders.index') }}">📦 سفارش‌ها</a>
                        
                        <div class="divider"></div>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit">🚪 خروج</button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="md-btn md-outlined md-sm" style="color:white;border-color:rgba(255,255,255,0.3);">
                    ورود
                </a>
                <a href="{{ route('register') }}" class="md-btn md-filled md-sm" style="background:rgba(255,255,255,0.2);color:white;">
                    ثبت‌نام
                </a>
            @endauth

            <button id="themeToggle" class="md-btn md-tonal md-sm md-round" style="background:rgba(255,255,255,0.1);color:white;">🌙</button>
        </div>
    </header>

    <main style="max-width:1000px;margin:40px auto;padding:35px;">
        @yield('content')
    </main>

    <footer class="site-footer">
        <div class="footer-info">
            <p>© 2025 FoodEase</p>
            <p>ایران، اصفهان - تلفن: 031-35289966</p>
        </div>
    </footer>

    <script>
        function toggleDropdown() {
            document.getElementById('userDropdown').classList.toggle('show');
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const toggle = document.querySelector('.dropdown-toggle');
            if (!toggle?.contains(event.target) && !dropdown?.contains(event.target)) {
                dropdown?.classList.remove('show');
            }
        });

        // سیستم تغییر تم
        document.getElementById('themeToggle').addEventListener('click', function() {
            document.body.classList.toggle('dark');
            this.textContent = document.body.classList.contains('dark') ? '☀️' : '🌙';
        });
    </script>

    <script src="{{ asset('js/theme.js') }}"></script>
    @yield('scripts')
</body>
</html>