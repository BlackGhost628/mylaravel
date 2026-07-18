@extends('layouts.app')

@section('title', 'جزئیات سفارش #' . $order->order_number)

@section('content')
<div class="max-w-4xl mx-auto py-8">

    {{-- عنوان --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 جزئیات سفارش</h1>
        <a href="{{ route('orders.index') }}" class="text-[#FF385C] hover:underline text-sm font-medium">← بازگشت به لیست سفارش‌ها</a>
    </div>

    {{-- پیام‌ها --}}
    @if(session('success'))
        <x-alert type="success">{{ session('success') }}</x-alert>
    @endif
    @if(session('error'))
        <x-alert type="error">{{ session('error') }}</x-alert>
    @endif

    {{-- اطلاعات سفارش --}}
    <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
        
        {{-- هدر سفارش --}}
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 flex flex-wrap items-center justify-between gap-3">
            <div>
                <span class="text-sm text-gray-500">شماره سفارش</span>
                <div class="font-bold text-gray-800">{{ $order->order_number }}</div>
            </div>
            <div>
                <span class="text-sm text-gray-500">کد رهگیری</span>
                <div class="font-mono font-bold text-[#FF385C]">{{ $order->tracking_code ?? '---' }}</div>
            </div>
            <div>
                <span class="text-sm text-gray-500">وضعیت سفارش</span>
                <div>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->status_badge }}">
                        {{ $order->status_persian }}
                    </span>
                </div>
            </div>
            <div>
                <span class="text-sm text-gray-500">تاریخ ثبت</span>
                <div class="font-medium text-gray-700">{{ $order->created_at->format('Y/m/d H:i') }}</div>
            </div>
        </div>

        {{-- بدنه --}}
        <div class="p-6">
            {{-- جدول اقلام سفارش --}}
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-right py-3 px-2 font-semibold text-gray-600">محصول</th>
                            <th class="text-center py-3 px-2 font-semibold text-gray-600">تعداد</th>
                            <th class="text-center py-3 px-2 font-semibold text-gray-600">قیمت واحد</th>
                            <th class="text-left py-3 px-2 font-semibold text-gray-600">قیمت کل</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-3 px-2">
                                <div class="flex items-center gap-3">
                                    @if($item->product && $item->product->image)
                                        <img src="{{ asset('image/' . $item->product->image) }}" 
                                             alt="{{ $item->product->name }}" 
                                             class="w-12 h-12 object-cover rounded-lg">
                                    @else
                                        <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center text-gray-400 text-xl">🍽️</div>
                                    @endif
                                    <span class="font-medium text-gray-800">{{ $item->product->name ?? 'محصول حذف شده' }}</span>
                                </div>
                            </td>
                            <td class="text-center py-3 px-2">{{ $item->quantity }}</td>
                            <td class="text-center py-3 px-2">{{ number_format($item->price) }} تومان</td>
                            <td class="text-left py-3 px-2 font-bold text-[#FF385C]">{{ number_format($item->quantity * $item->price) }} تومان</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-left py-4 px-2 font-bold text-gray-700 text-base">جمع کل</td>
                            <td class="text-left py-4 px-2 font-bold text-[#FF385C] text-xl">{{ number_format($order->total_price) }} تومان</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            {{-- اطلاعات تحویل --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6 pt-6 border-t border-gray-200">
                <div>
                    <h4 class="font-semibold text-gray-700 text-sm mb-1">📍 آدرس تحویل</h4>
                    <p class="text-gray-600 text-sm">{{ $order->address }}</p>
                </div>
                <div>
                    <h4 class="font-semibold text-gray-700 text-sm mb-1">📞 تلفن تماس</h4>
                    <p class="text-gray-600 text-sm">{{ $order->phone }}</p>
                </div>
                @if($order->notes)
                <div class="col-span-full">
                    <h4 class="font-semibold text-gray-700 text-sm mb-1">📝 توضیحات</h4>
                    <p class="text-gray-600 text-sm">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            {{-- وضعیت پرداخت و دکمه‌های پرداخت --}}
            <div class="mt-6 pt-6 border-t border-gray-200">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <span class="text-sm text-gray-500">وضعیت پرداخت</span>
                        <div class="mt-1">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-bold {{ $order->payment_status_badge }}">
                                {{ $order->payment_status_persian }}
                            </span>
                        </div>
                    </div>
                    @if($order->payment_status == 'pending')
                        <div class="flex gap-2">
                            <form action="{{ route('order.pay', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 bg-green-500 hover:bg-green-600 rounded-xl text-sm font-bold text-white transition shadow-md">
                                    💳 پرداخت موفق
                                </button>
                            </form>
                            <form action="{{ route('order.pay.fail', $order->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-5 py-2 bg-red-500 hover:bg-red-600 rounded-xl text-sm font-bold text-white transition shadow-md">
                                    ❌ پرداخت ناموفق
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            {{-- دکمه‌های پایین --}}
            <div class="mt-6 pt-6 border-t border-gray-200 flex flex-wrap gap-3">
                @if($order->tracking_code)
                    <a href="{{ route('track.show', $order->tracking_code) }}" 
                       class="px-5 py-2 bg-gray-100 hover:bg-gray-200 rounded-xl text-sm font-medium text-gray-700 transition">
                        🔍 پیگیری سفارش
                    </a>
                @endif
                <a href="{{ route('products') }}" class="px-5 py-2 bg-[#FF385C] hover:bg-red-600 rounded-xl text-sm font-bold text-white transition shadow-md shadow-red-100">
                    🛒 سفارش جدید
                </a>
            </div>
        </div>
    </div>
</div>
@endsection