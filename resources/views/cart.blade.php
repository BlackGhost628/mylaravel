@extends('layouts.app')

@section('title', 'سبد خرید - FoodEase')

@section('content')
<div class="max-w-6xl mx-auto py-8">

    {{-- عنوان --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🛒 سبد خرید</h1>
        <span class="text-sm text-gray-500">{{ count($cart) }} محصول</span>
    </div>

    {{-- پیام موفقیت --}}
    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif

    @if(empty($cart))
        {{-- سبد خرید خالی --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-12 text-center">
            <div class="text-7xl mb-4">🛒</div>
            <h2 class="text-2xl font-bold text-gray-700 mb-2">سبد خرید شما خالی است!</h2>
            <p class="text-gray-400 mb-6">برای شروع خرید، به صفحه منوی غذا بروید.</p>
            <x-button href="{{ route('products') }}" variant="primary" size="lg">
                مشاهده منو
            </x-button>
        </div>
    @else
        {{-- لیست محصولات --}}
        <div class="space-y-4">
            @foreach($cart as $id => $item)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 flex items-center gap-4 hover:shadow-md transition">
                <img src="{{ asset('image/' . $item['image']) }}" 
                     alt="{{ $item['name'] }}" 
                     class="w-20 h-20 object-cover rounded-xl flex-shrink-0">

                <div class="flex-1 min-w-0">
                    <h3 class="font-bold text-gray-800 text-base">{{ $item['name'] }}</h3>
                    <span class="text-[#FF385C] font-bold text-sm">{{ number_format($item['price']) }} تومان</span>
                </div>

                {{-- کنترل تعداد --}}
                <div class="flex items-center gap-2 bg-gray-50 rounded-xl px-2 py-1 border border-gray-200">
                    <button onclick="updateCart({{ $id }}, -1)" 
                            class="w-8 h-8 rounded-full hover:bg-gray-200 transition flex items-center justify-center text-gray-600 font-bold text-lg">
                        −
                    </button>
                    <input type="number" 
                           value="{{ $item['quantity'] }}" 
                           min="1" 
                           id="qty-{{ $id }}"
                           onchange="updateCart({{ $id }}, 0, this.value)"
                           class="w-12 text-center bg-transparent border-none font-bold text-gray-700 text-sm focus:outline-none">
                    <button onclick="updateCart({{ $id }}, 1)" 
                            class="w-8 h-8 rounded-full hover:bg-gray-200 transition flex items-center justify-center text-gray-600 font-bold text-lg">
                        +
                    </button>
                </div>

                {{-- قیمت کل --}}
                <div class="font-bold text-gray-800 min-w-[90px] text-left text-sm">
                    {{ number_format($item['price'] * $item['quantity']) }} تومان
                </div>

                {{-- حذف --}}
                <form action="{{ route('cart.remove', $id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="text-gray-400 hover:text-red-500 transition text-xl px-2" title="حذف">
                        ✕
                    </button>
                </form>
            </div>
            @endforeach
        </div>

        {{-- جمع کل و دکمه‌ها --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mt-6 flex flex-wrap items-center justify-between gap-4">
            <div>
                <span class="text-gray-500 text-sm">جمع کل</span>
                <div class="text-2xl font-bold text-gray-800">
                    <span class="text-[#FF385C]">{{ number_format($total) }}</span> تومان
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <form action="{{ route('cart.clear') }}" method="POST">
                    @csrf @method('DELETE')
                    <button type="submit" class="px-4 py-2 border border-red-300 text-red-500 rounded-xl hover:bg-red-50 transition text-sm font-medium">
                        🗑️ خالی کردن
                    </button>
                </form>

                <x-button href="{{ route('products') }}" variant="secondary" size="sm">
                    ← ادامه خرید
                </x-button>

                @auth
                    <x-button href="{{ route('checkout') }}" variant="primary" size="md">
                        💳 تکمیل سفارش
                    </x-button>
                @else
                    <x-button href="{{ route('login') }}" variant="primary" size="md">
                        🔑 ورود برای ثبت سفارش
                    </x-button>
                @endauth
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
function updateCart(id, change, value = null) {
    let input = document.getElementById('qty-' + id);
    let newQty = value !== null ? parseInt(value) : parseInt(input.value) + change;
    if (isNaN(newQty) || newQty < 1) newQty = 1;
    input.value = newQty;

    fetch('/cart/update/' + id, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ quantity: newQty })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) location.reload();
    });
}
</script>
@endsection