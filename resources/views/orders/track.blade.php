@extends('layouts.app')

@section('title', 'پیگیری سفارش - FoodEase')

@section('content')
<div class="max-w-3xl mx-auto py-8">

    <h1 class="text-2xl font-bold text-gray-800 mb-6">🔍 پیگیری سفارش</h1>

    {{-- فرم جستجو --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <form method="POST" action="{{ route('track.search') }}" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="text" name="tracking_code" 
                   class="flex-1 px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#FF385C] focus:border-transparent"
                   placeholder="کد رهگیری خود را وارد کنید..." 
                   value="{{ request('tracking_code') ?? (isset($order) ? $order->tracking_code : '') }}">
            <button type="submit" class="px-6 py-3 bg-[#FF385C] hover:bg-red-600 rounded-xl font-bold text-white transition shadow-md shadow-red-100">
                جستجو
            </button>
        </form>
        @error('tracking_code')
            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
        @enderror
    </div>

    {{-- نمایش نتیجه --}}
    @if(isset($order))
    <div class="mt-8 bg-white rounded-2xl shadow-md border border-gray-100 p-6">
        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800">سفارش #{{ $order->order_number }}</h2>
                <p class="text-sm text-gray-500">کد رهگیری: {{ $order->tracking_code }}</p>
            </div>
            <div>
                <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->status_badge }}">
                    {{ $order->status_persian }}
                </span>
            </div>
        </div>

        {{-- وضعیت پرداخت --}}
        <div class="mt-4">
            <span class="text-sm text-gray-500">وضعیت پرداخت:</span>
            <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->payment_status_badge }} ml-2">
                {{ $order->payment_status_persian }}
            </span>
        </div>

        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-500">تاریخ ثبت:</span>
                <span class="font-medium text-gray-700">{{ $order->created_at->format('Y/m/d H:i') }}</span>
            </div>
            <div>
                <span class="text-gray-500">مبلغ کل:</span>
                <span class="font-bold text-[#FF385C]">{{ number_format($order->total_price) }} تومان</span>
            </div>
            <div class="col-span-2">
                <span class="text-gray-500">آدرس تحویل:</span>
                <span class="font-medium text-gray-700">{{ $order->address }}</span>
            </div>
            <div class="col-span-2">
                <span class="text-gray-500">تلفن تماس:</span>
                <span class="font-medium text-gray-700">{{ $order->phone }}</span>
            </div>
        </div>

        {{-- دکمه مشاهده جزئیات کامل --}}
        @auth
            @if($order->user_id == Auth::id())
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <a href="{{ route('orders.show', $order->id) }}" class="text-[#FF385C] hover:underline font-medium text-sm">
                        مشاهده جزئیات کامل →
                    </a>
                </div>
            @endif
        @endauth
    </div>
    @endif
</div>
@endsection