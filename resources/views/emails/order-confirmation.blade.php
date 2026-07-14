<x-mail::message>
# سفارش شما ثبت شد! ✅

{{-- کاربر عزیز --}}
{{-- با تشکر از ثبت سفارش شما در FoodEase --}}

## 📋 جزئیات سفارش:

| مشخصات | مقدار |
|--------|-------|
| **شماره سفارش** | {{ $order->order_number }} |
| **کد رهگیری** | {{ $order->tracking_code }} |
| **تاریخ ثبت** | {{ $order->created_at->format('Y/m/d H:i') }} |
| **مبلغ کل** | {{ number_format($order->total_price) }} تومان |
| **وضعیت** | {{ $order->status_persian }} |

## 📍 آدرس تحویل:
{{ $order->address }}
تلفن: {{ $order->phone }}

@if($order->notes)
**توضیحات:** {{ $order->notes }}
@endif

---

برای پیگیری سفارش خود، روی دکمه زیر کلیک کنید:

<x-mail::button :url="route('track.show', $order->tracking_code)" color="success">
🔍 پیگیری سفارش
</x-mail::button>

با تشکر،  
تیم **FoodEase**
</x-mail::message>