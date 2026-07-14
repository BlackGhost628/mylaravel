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

    <div id="themeToggle" class="md-btn md-tonal md-sm md-round">🌙</div>
</header>

<style>
    .cart-badge {
        background-color: #e74c3c;
        color: white;
        border-radius: 50%;
        padding: 2px 8px;
        font-size: 12px;
        margin-right: 5px;
        display: inline-block;
    }
</style>