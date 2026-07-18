@extends('layouts.app')

@section('title', 'منوی غذا - FoodEase')
@section('description', 'منوی کامل غذاهای ایرانی و فست‌فود با قیمت مناسب - سفارش آنلاین از FoodEase')
@section('keywords', 'منوی غذا, پیتزا, کباب, سالاد, پاستا, برگر, سوشی, سفارش آنلاین غذا')
@section('og_title', 'منوی غذا - FoodEase')
@section('og_description', 'منوی کامل غذاهای ایرانی و فست‌فود با قیمت مناسب - سفارش آنلاین از FoodEase')
@section('og_image', asset('image/menu-banner.jpg'))

@section('content')
<div class="py-6">

    {{-- عنوان --}}
    <div class="flex justify-between items-center flex-wrap gap-4 mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🍽️ منوی غذا</h1>
        <span class="text-sm text-gray-500">{{ $products->total() }} محصول</span>
    </div>

    {{-- نوار جستجو --}}
    @include('partials.search-bar', [
        'route' => route('products'),
        'placeholder' => 'نام یا توضیحات...',
        'categories' => $categories,
        'showCategory' => true,
        'showSort' => true,
        'showPrice' => true,
        'showFeatured' => true,
    ])

    {{-- گرید محصولات --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
        @forelse($products as $product)
            <div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="relative">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                         class="w-full h-48 object-cover">
                    @if($product->is_featured)
                        <span class="absolute top-3 right-3 bg-yellow-400 text-black text-xs font-bold px-3 py-1 rounded-full">⭐ ویژه</span>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-gray-800 text-base">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ Str::limit($product->description, 55) }}</p>
                    <div class="flex items-center justify-between mt-3">
                        <span class="text-xl font-bold text-[#FF385C]">{{ $product->formatted_price }}</span>
                        <div class="flex items-center gap-1 text-sm text-gray-500">
                            <span>⭐</span> {{ $product->rating }}
                        </div>
                    </div>
                    <div class="flex gap-2 mt-4">
                        <a href="{{ route('products.show', $product->id) }}" 
                           class="flex-1 text-center px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium text-gray-700 transition">
                            👁️ مشاهده
                        </a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" 
                                    class="w-full px-3 py-2 bg-[#FF385C] hover:bg-red-600 rounded-xl text-sm font-bold text-white transition shadow-md shadow-red-100">
                                🛒 افزودن
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-16 text-gray-500">
                <div class="text-5xl mb-4">🔍</div>
                <h3 class="text-xl font-bold text-gray-700">هیچ محصولی یافت نشد</h3>
                <p class="mt-2">با فیلترهای دیگر جستجو کنید یا <a href="{{ route('products') }}" class="text-[#FF385C] font-semibold hover:underline">همه محصولات</a> را ببینید.</p>
            </div>
        @endforelse
    </div>

    {{-- صفحه‌بندی --}}
    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>
@endsection