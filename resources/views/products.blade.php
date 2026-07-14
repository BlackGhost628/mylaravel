@extends('layouts.app')

{{-- ===== متاتگ‌های سئو ===== --}}
@section('title', 'منوی غذا - FoodEase')
@section('description', 'منوی کامل غذاهای ایرانی و فست‌فود با قیمت مناسب - سفارش آنلاین از FoodEase')
@section('keywords', 'منوی غذا, پیتزا, کباب, سالاد, پاستا, برگر, سوشی, سفارش آنلاین غذا')
@section('og_title', 'منوی غذا - FoodEase')
@section('og_description', 'منوی کامل غذاهای ایرانی و فست‌فود با قیمت مناسب - سفارش آنلاین از FoodEase')
@section('og_image', asset('image/menu-banner.jpg'))

@section('styles')
<style>
    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }

    .product-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e9ecef;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    }
    .product-card img {
        width: 100%;
        height: 180px;
        object-fit: cover;
    }
    .product-card .body {
        padding: 16px 18px 18px;
    }
    .product-card .body h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 5px;
        color: #1f2937;
    }
    .product-card .body .desc {
        font-size: 13px;
        color: #6b7280;
        margin: 0 0 10px;
        line-height: 1.6;
        height: 40px;
        overflow: hidden;
    }
    .product-card .body .price {
        font-size: 18px;
        font-weight: 700;
        color: #FF385C;
        margin: 0 0 12px;
        display: block;
    }
    .product-card .body .actions {
        display: flex;
        gap: 8px;
    }
    .product-card .body .actions a,
    .product-card .body .actions button {
        flex: 1;
        padding: 8px 10px;
        border-radius: 10px;
        font-size: 13px;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.25s ease;
    }
    .product-card .body .actions .btn-view {
        background: #f1f3f5;
        color: #495057;
        border: 1px solid #e9ecef;
    }
    .product-card .body .actions .btn-view:hover {
        background: #e9ecef;
    }
    .product-card .body .actions .btn-cart {
        background: #FF385C;
        color: white;
        box-shadow: 0 4px 14px rgba(255,56,92,0.25);
    }
    .product-card .body .actions .btn-cart:hover {
        background: #e62e4f;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255,56,92,0.35);
    }
    .badge-featured {
        position: absolute;
        top: 12px;
        right: 12px;
        background: #ffc107;
        color: #000;
        font-size: 11px;
        font-weight: 700;
        padding: 3px 12px;
        border-radius: 20px;
        z-index: 2;
    }
    .product-card .img-wrap {
        position: relative;
    }
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    .empty-state .icon {
        font-size: 48px;
        margin-bottom: 15px;
    }
    .empty-state h3 {
        font-size: 20px;
        color: #2D2D2D;
        margin: 0 0 8px;
    }
    .empty-state p {
        margin: 0;
    }
    .empty-state a {
        color: #FF385C;
        text-decoration: none;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<section style="padding: 20px;">

    {{-- عنوان --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;margin-bottom:20px;">
        <h1 style="font-size:28px;font-weight:700;color:#2D2D2D;margin:0;">🍽️ منوی غذا</h1>
        <span style="color:#6c757d;font-size:14px;">{{ $products->total() }} محصول</span>
    </div>

    {{-- ===== نوار جستجوی پیشرفته ===== --}}
    @include('partials.search-bar', [
        'route' => route('products'),
        'placeholder' => 'نام یا توضیحات...',
        'categories' => $categories,
        'showCategory' => true,
        'showSort' => true,
        'showPrice' => true,
        'showFeatured' => true,
    ])

    {{-- ===== گرید محصولات ===== --}}
    <div class="product-grid">
        @forelse($products as $product)
            <article class="product-card">
                <div class="img-wrap">
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    @if($product->is_featured)
                        <span class="badge-featured">⭐ ویژه</span>
                    @endif
                </div>
                <div class="body">
                    <h3>{{ $product->name }}</h3>
                    <p class="desc">{{ Str::limit($product->description, 55) }}</p>
                    <span class="price">{{ $product->formatted_price }}</span>
                    <div class="actions">
                        <a href="{{ route('products.show', $product->id) }}" class="btn-view">👁️ مشاهده</a>
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="flex:1;">
                            @csrf
                            <button type="submit" class="btn-cart">🛒 افزودن</button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <div class="icon">🔍</div>
                <h3>هیچ محصولی یافت نشد</h3>
                <p>با فیلترهای دیگر جستجو کنید یا <a href="{{ route('products') }}">همه محصولات</a> را ببینید.</p>
            </div>
        @endforelse
    </div>

    {{-- ===== صفحه‌بندی ===== --}}
    <div style="margin-top:35px;">
        {{ $products->links() }}
    </div>
</section>
@endsection