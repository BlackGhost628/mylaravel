@extends('layouts.app')

@section('title', 'صفحه اصلی - FoodEase')

@section('content')
<!-- ===== بنر اصلی ===== -->
<section class="relative rounded-2xl overflow-hidden mb-8" style="background: linear-gradient(135deg, #FF385C 0%, #e62e4f 100%);">
    <div class="px-8 py-16 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">به FoodEase خوش آمدید!</h1>
        <p class="text-xl md:text-2xl mb-6 opacity-90">بهترین غذاها را با بهترین قیمت سفارش دهید</p>
        <a href="{{ route('products') }}" class="inline-block bg-white text-food-primary px-8 py-3 rounded-full font-bold hover:shadow-lg transition">
            مشاهده منو
        </a>
    </div>
</section>

<!-- ===== دسته‌بندی‌ها ===== -->
<section class="mb-8">
    <h2 class="text-2xl font-bold text-food-primary mb-4">دسته‌بندی غذاها</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($categories as $cat)
            <a href="{{ route('products') }}?category={{ $cat->category }}" 
               class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition hover:-translate-y-1">
                <div class="text-4xl mb-2">
                    @switch($cat->category)
                        @case('pizza') 🍕 @break
                        @case('kebab') 🥩 @break
                        @case('salad') 🥗 @break
                        @case('pasta') 🍝 @break
                        @case('burger') 🍔 @break
                        @case('sushi') 🍣 @break
                        @default 🍽️
                    @endswitch
                </div>
                <div class="font-bold text-sm">
                    @switch($cat->category)
                        @case('pizza') پیتزا @break
                        @case('kebab') کباب @break
                        @case('salad') سالاد @break
                        @case('pasta') پاستا @break
                        @case('burger') برگر @break
                        @case('sushi') سوشی @break
                        @default {{ $cat->category }}
                    @endswitch
                </div>
                <div class="text-xs text-gray-400">{{ $cat->count }} محصول</div>
            </a>
        @endforeach
    </div>
</section>

<!-- ===== محصولات ویژه ===== -->
<section class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-food-primary">🔥 محصولات ویژه</h2>
        <a href="{{ route('products') }}" class="text-food-primary hover:underline">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($featuredProducts as $product)
            <div class="product-card">
                <div class="relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-xl">
                    <span class="absolute top-2 right-2 bg-food-primary text-white text-xs px-2 py-1 rounded-full">ویژه</span>
                </div>
                <h3 class="font-bold mt-2">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                <div class="flex items-center justify-between mt-2">
                    <span class="font-bold text-food-primary">{{ $product->formatted_price }}</span>
                    <div class="flex items-center gap-1">
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-sm">{{ $product->rating }}</span>
                    </div>
                </div>
                <div class="flex gap-2 mt-2">
    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
        @csrf
        <button type="submit" class="w-full bg-food-primary text-white text-sm py-2 px-4 rounded-xl font-bold hover:bg-red-600 transition">
            🛒 افزودن به سبد
        </button>
    </form>
    <button class="like-btn text-xl px-3 py-1 border rounded-xl hover:bg-gray-50 transition" data-liked="false">
        ♡
    </button>
</div>
            </div>
        @empty
            <p class="text-gray-500">هیچ محصول ویژه‌ای وجود ندارد.</p>
        @endforelse
    </div>
</section>

<!-- ===== محصولات جدید ===== -->
<section class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-food-primary">🆕 جدیدترین محصولات</h2>
        <a href="{{ route('products') }}" class="text-food-primary hover:underline">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @forelse($latestProducts as $product)
            <div class="bg-white rounded-xl p-3 shadow hover:shadow-lg transition">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-28 object-cover rounded-lg">
                <h4 class="font-bold text-sm mt-2">{{ $product->name }}</h4>
                <span class="text-food-primary font-bold text-sm">{{ $product->formatted_price }}</span>
            </div>
        @empty
            <p class="text-gray-500">هیچ محصولی وجود ندارد.</p>
        @endforelse
    </div>
</section>

<!-- ===== محصولات پرفروش ===== -->
<section class="mb-8">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-food-primary">⭐ پرفروش‌ترین‌ها</h2>
        <a href="{{ route('products') }}" class="text-food-primary hover:underline">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @forelse($popularProducts as $product)
            <div class="bg-white rounded-xl p-3 shadow hover:shadow-lg transition">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-28 object-cover rounded-lg">
                <h4 class="font-bold text-sm mt-2">{{ $product->name }}</h4>
                <div class="flex justify-between items-center">
                    <span class="text-food-primary font-bold text-sm">{{ $product->formatted_price }}</span>
                    <span class="text-xs text-gray-400">❤️ {{ $product->likes }}</span>
                </div>
            </div>
        @empty
            <p class="text-gray-500">هیچ محصولی وجود ندارد.</p>
        @endforelse
    </div>
</section>
@endsection

@section('scripts')
<script>
    // سیستم لایک ساده
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('liked');
            if (this.classList.contains('liked')) {
                this.innerHTML = '❤️';
                this.style.color = '#e74c3c';
            } else {
                this.innerHTML = '♡';
                this.style.color = '#999';
            }
        });
    });
</script>
@endsection