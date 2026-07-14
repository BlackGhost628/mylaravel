@extends('layouts.app')

@section('title', 'پیگیری سفارش - FoodEase')

@section('content')
<div style="max-width: 600px; margin: 40px auto; padding: 20px;">

    <h1 style="font-size: 28px; font-weight: 700; color: #2D2D2D; text-align: center; margin-bottom: 30px;">🔍 پیگیری سفارش</h1>

    {{-- فرم جستجو --}}
    <form method="GET" action="{{ route('orders.track') }}" style="background: #f8f9fa; padding: 25px; border-radius: 16px; box-shadow: 0 2px 10px rgba(0,0,0,0.05);">
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <input type="text" name="tracking_code" value="{{ request('tracking_code') }}"
                   style="flex: 1; min-width: 200px; padding: 12px 16px; border: 2px solid #e9ecef; border-radius: 10px; font-size: 14px; outline: none; transition: border-color 0.3s;"
                   placeholder="کد رهگیری را وارد کنید...">
            <button type="submit"
                    style="padding: 12px 28px; background: #FF385C; color: white; border: none; border-radius: 10px; font-weight: 600; font-size: 14px; cursor: pointer; transition: background 0.3s;">
                جستجو
            </button>
        </div>
    </form>

    {{-- نمایش نتیجه --}}
    @if(isset($order))
        <div style="margin-top: 30px; background: white; border-radius: 16px; border: 1px solid #e9ecef; padding: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; border-bottom: 2px solid #f1f3f5; padding-bottom: 15px; margin-bottom: 20px;">
                <h2 style="font-size: 20px; font-weight: 700; color: #2D2D2D; margin: 0;">سفارش #{{ $order->order_number }}</h2>
                <span style="font-size: 14px; color: #6c757d;">{{ $order->created_at->format('Y/m/d H:i') }}</span>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
                <div>
                    <p style="margin: 0 0 4px; font-size: 13px; color: #adb5bd;">کد رهگیری</p>
                    <p style="margin: 0; font-weight: 700; font-size: 16px; color: #2D2D2D; direction: ltr; text-align: left;">{{ $order->tracking_code }}</p>
                </div>
                <div>
                    <p style="margin: 0 0 4px; font-size: 13px; color: #adb5bd;">وضعیت</p>
                    <span style="display: inline-block; padding: 4px 14px; border-radius: 20px; font-size: 14px; font-weight: 600; 
                        @if($order->status == 'pending') background: #ffc107; color: #000;
                        @elseif($order->status == 'processing') background: #17a2b8; color: #fff;
                        @elseif($order->status == 'delivered') background: #28a745; color: #fff;
                        @elseif($order->status == 'cancelled') background: #dc3545; color: #fff;
                        @endif">
                        {{ $order->status_persian ?? $order->status }}
                    </span>
                </div>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="margin: 0 0 4px; font-size: 13px; color: #adb5bd;">آدرس تحویل</p>
                <p style="margin: 0; font-size: 14px; color: #495057;">{{ $order->address }}</p>
            </div>

            <div style="margin-bottom: 20px;">
                <p style="margin: 0 0 8px; font-size: 13px; color: #adb5bd;">اقلام سفارش</p>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($order->items as $item)
                        <li style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid #f1f3f5; font-size: 14px;">
                            <span>{{ $item->product->name ?? 'محصول حذف شده' }} ({{ $item->quantity }})</span>
                            <span>{{ number_format($item->price * $item->quantity) }} تومان</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div style="display: flex; justify-content: space-between; font-size: 18px; font-weight: 700; border-top: 2px solid #f1f3f5; padding-top: 15px;">
                <span>جمع کل</span>
                <span style="color: #FF385C;">{{ number_format($order->total_price) }} تومان</span>
            </div>
        </div>
    @elseif(request()->has('tracking_code'))
        <div style="margin-top: 30px; background: #f8d7da; color: #721c24; padding: 15px 20px; border-radius: 10px; text-align: center;">
            ❌ کد رهگیری وارد شده معتبر نیست.
        </div>
    @else
        <div style="margin-top: 30px; text-align: center; color: #6c757d;">
            <p style="font-size: 16px;">کد رهگیری خود را وارد کنید تا وضعیت سفارش را ببینید.</p>
        </div>
    @endif

    <div style="margin-top: 25px; text-align: center;">
        <a href="{{ route('home') }}" style="color: #FF385C; text-decoration: none; font-weight: 600;">← بازگشت به صفحه اصلی</a>
    </div>
</div>
@endsection