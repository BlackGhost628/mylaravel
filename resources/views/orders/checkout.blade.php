@extends('layouts.app')

@section('title', 'تکمیل سفارش - FoodEase')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">💳 تکمیل سفارش</h1>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6">
        <h2 class="font-bold text-lg mb-4">خلاصه سفارش</h2>
        @foreach($cart as $item)
            <div class="flex justify-between py-2 border-b border-gray-100">
                <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                <span>{{ number_format($item['price'] * $item['quantity']) }} تومان</span>
            </div>
        @endforeach
        <div class="flex justify-between font-bold text-lg mt-4 pt-4 border-t border-gray-300">
            <span>جمع کل</span>
            <span class="text-[#FF385C]">{{ number_format($total) }} تومان</span>
        </div>
    </div>

    <form action="{{ route('orders.store') }}" method="POST" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
        @csrf

        <div class="mb-4">
            <label for="address" class="block font-medium text-gray-700 mb-1">آدرس تحویل *</label>
            <textarea id="address" name="address" rows="3" 
                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FF385C] focus:border-transparent"
                      placeholder="آدرس کامل خود را وارد کنید...">{{ old('address') }}</textarea>
            @error('address') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-4">
            <label for="phone" class="block font-medium text-gray-700 mb-1">شماره تماس *</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone', Auth::user()->phone ?? '') }}"
                   class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FF385C] focus:border-transparent"
                   placeholder="09123456789">
            @error('phone') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="mb-6">
            <label for="notes" class="block font-medium text-gray-700 mb-1">توضیحات اضافی (اختیاری)</label>
            <textarea id="notes" name="notes" rows="2"
                      class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:ring-2 focus:ring-[#FF385C] focus:border-transparent"
                      placeholder="توضیحات اضافی...">{{ old('notes') }}</textarea>
        </div>

        <div class="flex flex-wrap gap-4">
            <a href="{{ route('cart.index') }}" class="px-6 py-3 border border-gray-300 rounded-xl hover:bg-gray-50 transition text-gray-700">
                ← بازگشت به سبد خرید
            </a>
            <button type="submit" class="px-8 py-3 bg-[#FF385C] text-white rounded-xl font-bold hover:bg-red-600 transition shadow-lg shadow-red-100">
                ثبت سفارش نهایی
            </button>
        </div>
    </form>
</div>
@endsection