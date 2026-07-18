@extends('layouts.app')

@section('title', 'صفحه اصلی - FoodEase')

@section('content')
{{-- بنر اصلی --}}
<section class="relative rounded-2xl overflow-hidden mb-10 bg-gradient-to-l from-[#FF385C] to-red-600 text-white">
    <div class="px-6 py-16 md:py-20 text-center">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">به FoodEase خوش آمدید!</h1>
        <p class="text-lg md:text-xl mb-6 opacity-90">بهترین غذاها را با بهترین قیمت سفارش دهید</p>
        <x-button href="{{ route('products') }}" variant="secondary" size="lg">
            🍽️ مشاهده منو
        </x-button>
    </div>
</section>

{{-- دسته‌بندی‌ها --}}
<section class="mb-10">
    <h2 class="text-2xl font-bold text-[#FF385C] mb-4">📂 دسته‌بندی غذاها</h2>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4">
        @foreach($categories as $cat)
            <a href="{{ route('products') }}?category={{ $cat->category }}" 
               class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition hover:-translate-y-1 border border-gray-100">
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
                <div class="font-bold text-sm text-gray-800">
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

{{-- محصولات ویژه --}}
<section class="mb-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-[#FF385C]">🔥 محصولات ویژه</h2>
        <a href="{{ route('products') }}" class="text-[#FF385C] hover:underline font-medium">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
        @forelse($featuredProducts as $product)
            <x-card padding="p-4" hover="true">
                <div class="relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                         class="w-full h-40 object-cover rounded-xl">
                    <span class="absolute top-2 right-2 bg-[#FF385C] text-white text-xs px-3 py-1 rounded-full font-bold">ویژه</span>
                </div>
                <h3 class="font-bold text-gray-800 mt-3">{{ $product->name }}</h3>
                <p class="text-sm text-gray-500">{{ Str::limit($product->description, 40) }}</p>
                <div class="flex items-center justify-between mt-2">
                    <span class="font-bold text-[#FF385C]">{{ $product->formatted_price }}</span>
                    <div class="flex items-center gap-1">
                        <span class="text-yellow-400">⭐</span>
                        <span class="text-sm text-gray-600">{{ $product->rating }}</span>
                    </div>
                </div>
                <div class="flex gap-2 mt-3">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                        @csrf
                        <x-button type="submit" variant="primary" size="sm" class="w-full text-sm">
                            🛒 افزودن به سبد
                        </x-button>
                    </form>
                    <button class="like-btn text-xl px-3 py-1 border border-gray-300 rounded-xl hover:bg-gray-50 transition" data-liked="false">
                        ♡
                    </button>
                </div>
            </x-card>
        @empty
            <p class="text-gray-500 col-span-full text-center py-10">هیچ محصول ویژه‌ای وجود ندارد.</p>
        @endforelse
    </div>
</section>

{{-- محصولات جدید --}}
<section class="mb-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-[#FF385C]">🆕 جدیدترین محصولات</h2>
        <a href="{{ route('products') }}" class="text-[#FF385C] hover:underline font-medium">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @forelse($latestProducts as $product)
            <x-card padding="p-3" hover="true">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                     class="w-full h-28 object-cover rounded-lg">
                <h4 class="font-bold text-sm text-gray-800 mt-2">{{ $product->name }}</h4>
                <span class="text-[#FF385C] font-bold text-sm">{{ $product->formatted_price }}</span>
            </x-card>
        @empty
            <p class="text-gray-500 col-span-full text-center py-10">هیچ محصولی وجود ندارد.</p>
        @endforelse
    </div>
</section>

{{-- محصولات پرفروش --}}
<section class="mb-10">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold text-[#FF385C]">⭐ پرفروش‌ترین‌ها</h2>
        <a href="{{ route('products') }}" class="text-[#FF385C] hover:underline font-medium">مشاهده همه →</a>
    </div>
    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
        @forelse($popularProducts as $product)
            <x-card padding="p-3" hover="true">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                     class="w-full h-28 object-cover rounded-lg">
                <h4 class="font-bold text-sm text-gray-800 mt-2">{{ $product->name }}</h4>
                <div class="flex justify-between items-center">
                    <span class="text-[#FF385C] font-bold text-sm">{{ $product->formatted_price }}</span>
                    <span class="text-xs text-gray-400">❤️ {{ $product->likes }}</span>
                </div>
            </x-card>
        @empty
            <p class="text-gray-500 col-span-full text-center py-10">هیچ محصولی وجود ندارد.</p>
        @endforelse
    </div>
</section>
@endsection

@section('scripts')
<script>
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