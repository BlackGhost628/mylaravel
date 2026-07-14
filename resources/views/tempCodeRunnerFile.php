<?php
@extends('layouts.app')

@section('title', 'منوی غذا - FoodEase')

@section('styles')
<style>
    .filter-bar {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        justify-content: space-between;
        align-items: center;
    }
    .filter-bar input, .filter-bar select {
        padding: 10px 16px;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        min-width: 150px;
        background: white;
        color: #1f2937;
        font-size: 14px;
        transition: 0.3s;
    }
    .filter-bar input:focus, .filter-bar select:focus {
        border-color: #FF385C;
        outline: none;
        box-shadow: 0 0 0 3px rgba(255,56,92,0.1);
    }

    .product-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }

    .product-card {
        background: white;
        padding: 16px;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(0,0,0,0.08);
        transition: all 0.3s;
        display: flex;
        flex-direction: column;
    }
    .product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 30px rgba(0,0,0,0.12);
    }

    .product-card img {
        width: 100%;
        height: 160px;
        object-fit: cover;
        border-radius: 12px;
    }

    .product-card h3 {
        font-size: 16px;
        font-weight: 700;
        margin: 10px 0 4px;
        color: #1f2937;
    }

    .product-card .description {
        font-size: 13px;
        color: #6b7280;
        flex: 1;
        margin-bottom: 8px;
    }

    .product-card .price {
        font-size: 18px;
        font-weight: 700;
        color: #FF385C;
        margin: 8px 0;
    }

    .category-links, .featured-link {
        margin-bottom: 12px;
    }
    .category-links a, .featured-link a {
        margin-left: 10px;
        text-decoration: none;
        color: #4b5563;
        padding: 4px 12px;
        border-radius: 20px;
        border: 1px solid #e5e7eb;
        transition: 0.3s;
        font-size: 13px;
        display: inline-block;
        margin-bottom: 4px;
    }
    .category-links a:hover, .featured-link a:hover {
        background: #FF385C;
        color: white;
        border-color: #FF385C;
    }
</style>
@endsection

@section('content')
<section style="padding: 20px;">
    <!-- دسته بندی -->
    <div class="category-links">
        <strong>دسته‌بندی:</strong>
        <a href="#" data-category="all" class="active">همه</a>
        @php
            $categories = $products->pluck('category')->unique();
        @endphp
        @foreach($categories as $category)
            <a href="#" data-category="{{ $category }}">
                @switch($category)
                    @case('pizza') 🍕 پیتزا @break
                    @case('kebab') 🥩 کباب @break
                    @case('salad') 🥗 سالاد @break
                    @case('pasta') 🍝 پاستا @break
                    @default {{ $category }}
                @endswitch
            </a>
        @endforeach
    </div>

    <!-- فیلتر و جستجو -->
    <div class="filter-bar">
        <input type="text" id="searchInput" placeholder="🔍 جستجوی محصول..." />
        <select id="sortSelect">
            <option value="default">مرتب‌سازی</option>
            <option value="price-asc">💰 قیمت از کم به زیاد</option>
            <option value="price-desc">💰 قیمت از زیاد به کم</option>
            <option value="name-asc">🔤 نام A-Z</option>
            <option value="name-desc">🔤 نام Z-A</option>
        </select>
    </div>

    <!-- گرید محصولات -->
    <div class="product-grid" id="productGrid">
        @foreach($products as $product)
            <article class="product-card" 
                     data-category="{{ $product->category }}" 
                     data-name="{{ $product->name }}" 
                     data-price="{{ $product->price }}">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                <h3>{{ $product->name }}</h3>
                <p class="description">{{ Str::limit($product->description, 50) }}</p>
                <span class="price">{{ $product->formatted_price }}</span>
                
                <div style="display:flex;gap:8px;margin-top:10px;flex-wrap:wrap;">
                    <a href="{{ route('products.show', $product->id) }}" class="px-4 py-2 border border-gray-300 rounded-xl text-sm hover:bg-gray-50 transition flex-1 text-center">
                        👁️ مشاهده
                    </a>
                    <form action="{{ route('cart.add', $product->id) }}" method="POST" class="inline-block">
    @csrf
    <button type="submit" 
            class="w-full bg-[#FF385C] text-white px-4 py-2.5 rounded-xl text-sm font-bold hover:bg-red-600 transition shadow-md shadow-red-100">
        🛒 افزودن به سبد
    </button>
</form>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection

@section('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const sortSelect = document.getElementById('sortSelect');
    const productGrid = document.getElementById('productGrid');
    const products = Array.from(productGrid.children);

    // جستجو
    searchInput.addEventListener('input', function() {
        const term = this.value.trim().toLowerCase();
        products.forEach(p => {
            const name = p.dataset.name.toLowerCase();
            p.style.display = name.includes(term) ? '' : 'none';
        });
    });

    // مرتب‌سازی
    sortSelect.addEventListener('change', function() {
        const val = this.value;
        let sorted = [...products];
        if(val === 'price-asc') sorted.sort((a,b)=> a.dataset.price - b.dataset.price);
        if(val === 'price-desc') sorted.sort((a,b)=> b.dataset.price - a.dataset.price);
        if(val === 'name-asc') sorted.sort((a,b)=> a.dataset.name.localeCompare(b.dataset.name));
        if(val === 'name-desc') sorted.sort((a,b)=> b.dataset.name.localeCompare(a.dataset.name));
        productGrid.innerHTML = '';
        sorted.forEach(p=>productGrid.appendChild(p));
    });

    // فیلتر دسته‌بندی
    document.querySelectorAll('[data-category]').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.dataset.category;
            
            document.querySelectorAll('[data-category]').forEach(l => l.classList.remove('active'));
            this.classList.add('active');
            
            products.forEach(p => {
                if (category === 'all' || p.dataset.category === category) {
                    p.style.display = '';
                } else {
                    p.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection