@extends('layouts.app')

@section('title', $product->name . ' - FoodEase')

@section('styles')
<style>
    .product-detail {
        display: flex;
        gap: 40px;
        flex-wrap: wrap;
        padding: 20px;
    }
    .product-detail img {
        max-width: 400px;
        width: 100%;
        border-radius: 12px;
        object-fit: cover;
    }
    .product-info {
        flex: 1;
        min-width: 250px;
    }
    .product-info h1 {
        color: var(--md-sys-color-primary);
        margin-bottom: 15px;
    }
    .product-info .price {
        font-size: 28px;
        font-weight: bold;
        color: var(--md-sys-color-secondary);
        margin: 20px 0;
    }
    .product-info .description {
        font-size: 16px;
        line-height: 1.8;
        margin: 20px 0;
    }
    .product-info .category {
        display: inline-block;
        background: var(--md-sys-color-primary-container);
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 14px;
    }
</style>
@endsection

@section('content')
<section class="md-card md-card-elevated" style="max-width:1000px;margin:40px auto;padding:30px;">
    <div class="product-detail">
        <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
        
        <div class="product-info">
            <h1>{{ $product->name }}</h1>
            
            <div class="category">دسته: 
                @switch($product->category)
                    @case('pizza') پیتزا @break
                    @case('kebab') کباب @break
                    @case('salad') سالاد @break
                    @case('pasta') پاستا @break
                    @default {{ $product->category }}
                @endswitch
            </div>
            
            <div class="price">{{ $product->formatted_price }}</div>
            
            <div class="description">
                <strong>توضیحات:</strong>
                <p>{{ $product->description }}</p>
            </div>
            
            <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:20px;">
                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="md-btn md-filled md-lg">🛒 افزودن به سبد خرید</button>
                </form>
                <a href="{{ route('products') }}" class="md-btn md-outlined md-lg">← بازگشت به منو</a>
            </div>
            
            <div style="margin-top:20px;display:flex;gap:20px;">
                <span>⭐ امتیاز: {{ $product->rating }}/5</span>
                <span>❤️ {{ $product->likes }} لایک</span>
            </div>
        </div>
    </div>
</section>
@endsection