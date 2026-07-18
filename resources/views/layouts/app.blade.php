<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodEase')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- ===== استایل‌های تم ===== --}}
    <style>
        /* ===== تم روشن ===== */
        body.light {
            background-color: #f3f4f6;
            color: #1f2937;
            transition: background-color 0.3s, color 0.3s;
        }
        body.light header {
            background-color: #FF385C;
        }
        body.light footer {
            background-color: #1f2937;
            color: white;
        }
        body.light .bg-white {
            background-color: #ffffff;
            color: #1f2937;
        }
        body.light .text-gray-800 {
            color: #1f2937;
        }
        body.light .text-gray-500 {
            color: #6b7280;
        }
        body.light .border-gray-200 {
            border-color: #e5e7eb;
        }
        body.light .bg-gray-50 {
            background-color: #f9fafb;
        }
        body.light .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        /* ===== تم تیره ===== */
        body.dark {
            background-color: #0f172a;
            color: #e2e8f0;
            transition: background-color 0.3s, color 0.3s;
        }
        body.dark header {
            background-color: #1e293b !important;
        }
        body.dark footer {
            background-color: #0f172a !important;
            color: #e2e8f0 !important;
        }
        body.dark .bg-white {
            background-color: #1e293b !important;
            color: #e2e8f0 !important;
        }
        body.dark .text-gray-800 {
            color: #e2e8f0 !important;
        }
        body.dark .text-gray-500 {
            color: #94a3b8 !important;
        }
        body.dark .border-gray-200 {
            border-color: #334155 !important;
        }
        body.dark .bg-gray-50 {
            background-color: #0f172a !important;
        }
        body.dark .shadow-md {
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.5);
        }
        body.dark .cart-badge {
            background-color: #ef4444;
            color: white;
        }
        body.dark .md-btn {
            background-color: #334155;
            color: #e2e8f0;
        }
    </style>
</head>
<body class="light antialiased">

    {{-- ===== HEADER ===== --}}
    <header class="text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20 md:h-24">

                {{-- لوگو --}}
                <div class="flex-shrink-0">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <img src="{{ asset('image/logo.png') }}" alt="FoodEase Logo" 
                             class="h-14 w-auto rounded-full border-2 border-white shadow-md">
                    </a>
                </div>

                {{-- منوی اصلی --}}
                <nav class="hidden md:flex items-center space-x-1 rtl:space-x-reverse">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('home')) bg-white/30 @endif">صفحه اصلی</a>
                    <a href="{{ route('products') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('products')) bg-white/30 @endif">منوی غذا</a>
                    <a href="{{ route('cart') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('cart')) bg-white/30 @endif relative">
                        🛒 سبد خرید
                        @php
                            $cartCount = 0;
                            $cart = Session::get('cart', []);
                            foreach ($cart as $item) { $cartCount += $item['quantity']; }
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center font-bold">{{ $cartCount }}</span>
                        @endif
                    </a>
                    <a href="{{ route('about') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('about')) bg-white/30 @endif">درباره ما</a>
                    <a href="{{ route('team') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('team')) bg-white/30 @endif">تیم ما</a>
                    <a href="{{ route('contact') }}" class="px-4 py-2 rounded-xl text-sm font-medium hover:bg-white/20 transition @if(Route::is('contact')) bg-white/30 @endif">تماس با ما</a>
                </nav>

                {{-- دکمه‌های سمت راست --}}
                <div class="flex items-center gap-4">
                    @auth
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-2 bg-white/10 hover:bg-white/20 rounded-full px-4 py-2 text-sm transition">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-xl py-1 z-50 border border-gray-200 dark:border-gray-700">
                                <div class="px-4 py-2 border-b border-gray-200 dark:border-gray-700">
                                    <strong class="block text-gray-800 dark:text-white">{{ Auth::user()->name }}</strong>
                                    <small class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</small>
                                </div>
                                @if(Auth::user()->is_admin)
                                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">⚙️ پنل مدیریت</a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">👤 پروفایل</a>
                                <a href="{{ route('orders.index') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700">📦 سفارش‌ها</a>
                                <hr class="my-1 border-gray-200 dark:border-gray-700">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="block w-full text-right px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-700">🚪 خروج</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 rounded-full text-sm font-medium border border-white/40 hover:bg-white/10 transition">ورود</a>
                        <a href="{{ route('register') }}" class="px-5 py-2 rounded-full text-sm font-medium bg-white/20 hover:bg-white/30 transition">ثبت‌نام</a>
                    @endauth

                    {{-- ===== دکمه تغییر تم (با id ثابت) ===== --}}
                    <button id="themeToggle" class="p-2.5 rounded-full hover:bg-white/10 transition text-xl">
                        🌙
                    </button>
                </div>

                {{-- دکمه منوی موبایل --}}
                <div class="md:hidden">
                    <button id="mobileMenuButton" class="p-2 rounded-lg hover:bg-white/10 transition">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                </div>
            </div>
        </div>

        {{-- منوی موبایل --}}
        <div id="mobileMenu" class="md:hidden hidden bg-[#FF385C] px-4 pb-5 pt-2 space-y-1">
            <a href="{{ route('home') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">صفحه اصلی</a>
            <a href="{{ route('products') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">منوی غذا</a>
            <a href="{{ route('cart') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">سبد خرید</a>
            <a href="{{ route('about') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">درباره ما</a>
            <a href="{{ route('team') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">تیم ما</a>
            <a href="{{ route('contact') }}" class="block py-2.5 px-3 rounded-xl hover:bg-white/10 transition text-sm font-medium">تماس با ما</a>
        </div>
    </header>

    {{-- ===== محتوای اصلی ===== --}}
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    {{-- ===== فوتر ===== --}}
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 text-center">
            <p class="text-lg font-medium">© 2025 FoodEase</p>
            <p class="text-sm text-gray-400 mt-1">ایران، اصفهان - تلفن: 031-35289966</p>
        </div>
    </footer>

    {{-- ===== اسکریپت‌ها (همه در یک جا) ===== --}}
    <script>
        // ========== 1. منوی موبایل ==========
        document.getElementById('mobileMenuButton').addEventListener('click', function() {
            document.getElementById('mobileMenu').classList.toggle('hidden');
        });

        // ========== 2. منوی کاربر (برای Alpine) ==========
        document.querySelectorAll('[x-data]').forEach(el => {
            if (el.getAttribute('x-data').includes('open')) {
                let open = false;
                const btn = el.querySelector('button');
                const menu = el.querySelector('[x-show]');
                if (btn && menu) {
                    btn.addEventListener('click', function(e) {
                        e.stopPropagation();
                        open = !open;
                        menu.style.display = open ? 'block' : 'none';
                    });
                    document.addEventListener('click', function() {
                        if (open) {
                            open = false;
                            menu.style.display = 'none';
                        }
                    });
                }
            }
        });

        // ========== 3. تغییر تم (مهم‌ترین بخش) ==========
        (function() {
            // پیدا کردن دکمه
            var toggleBtn = document.getElementById('themeToggle');
            if (!toggleBtn) {
                console.log('دکمه تغییر تم پیدا نشد!');
                return;
            }

            var body = document.body;

            // تابع تنظیم تم
            function setTheme(theme) {
                if (theme === 'dark') {
                    body.classList.add('dark');
                    body.classList.remove('light');
                    toggleBtn.textContent = '☀️';
                    localStorage.setItem('theme', 'dark');
                } else {
                    body.classList.add('light');
                    body.classList.remove('dark');
                    toggleBtn.textContent = '🌙';
                    localStorage.setItem('theme', 'light');
                }
                console.log('تم تغییر کرد به: ' + theme);
            }

            // بارگذاری تم ذخیره شده
            var savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                setTheme('dark');
            } else {
                setTheme('light');
            }

            // رویداد کلیک روی دکمه
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('دکمه کلیک شد!');
                if (body.classList.contains('dark')) {
                    setTheme('light');
                } else {
                    setTheme('dark');
                }
            });

            console.log('سیستم تغییر تم با موفقیت راه‌اندازی شد!');
        })();
    </script>

    @yield('scripts')
</body>
</html>