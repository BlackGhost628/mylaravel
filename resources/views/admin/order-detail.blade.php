@extends('admin.layout')

@section('title', 'جزئیات سفارش #' . $order->order_number)

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-receipt"></i> جزئیات سفارش: {{ $order->order_number }}</h5>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-right"></i> بازگشت
        </a>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <h6>اطلاعات سفارش</h6>
                <hr>
                <p><strong>شماره سفارش:</strong> {{ $order->order_number }}</p>
                <p><strong>کد رهگیری:</strong> {{ $order->tracking_code ?? '-' }}</p>
                <p><strong>کاربر:</strong> {{ $order->user->name ?? 'نامشخص' }}</p>
                <p><strong>ایمیل:</strong> {{ $order->user->email ?? '-' }}</p>
                <p><strong>تاریخ ثبت:</strong> {{ $order->created_at->format('Y/m/d H:i') }}</p>
                <p><strong>وضعیت سفارش:</strong> 
                    <span class="badge {{ $order->status_badge ?? 'bg-secondary' }}">
                        {{ $order->status_persian ?? $order->status }}
                    </span>
                </p>
                <p><strong>وضعیت پرداخت:</strong> 
                    <span class="badge {{ $order->payment_status_badge ?? 'bg-secondary' }}">
                        {{ $order->payment_status_persian ?? $order->payment_status }}
                    </span>
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3 mb-3">
                <h6>اطلاعات تحویل</h6>
                <hr>
                <p><strong>آدرس:</strong> {{ $order->address }}</p>
                <p><strong>تلفن:</strong> {{ $order->phone }}</p>
                @if($order->notes)
                    <p><strong>توضیحات:</strong> {{ $order->notes }}</p>
                @endif
            </div>
        </div>
    </div>

    {{-- تغییر وضعیت سفارش --}}
    <div class="card p-3 mb-3">
        <h6>تغییر وضعیت سفارش</h6>
        <hr>
        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="row g-2">
            @csrf
            <div class="col-md-4">
                <select name="status" class="form-control">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>در انتظار</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>در حال آماده‌سازی</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>تحویل شده</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>لغو شده</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn-admin-primary">بروزرسانی</button>
            </div>
        </form>
    </div>

    {{-- لیست اقلام سفارش --}}
    <div class="card p-3">
        <h6>اقلام سفارش</h6>
        <hr>
        <div class="table-responsive">
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>محصول</th>
                        <th>تعداد</th>
                        <th>قیمت واحد</th>
                        <th>قیمت کل</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                        <tr>
                            <td>{{ $item->product->name ?? 'محصول حذف شده' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price) }} تومان</td>
                            <td>{{ number_format($item->quantity * $item->price) }} تومان</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-left">جمع کل:</th>
                        <th>{{ number_format($order->total_price) }} تومان</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{-- دکمه‌ها --}}
    <div class="mt-3">
        <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('آیا مطمئن هستید؟')">
                <i class="fas fa-trash"></i> حذف سفارش
            </button>
        </form>
        <a href="{{ route('admin.orders') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-right"></i> بازگشت
        </a>
    </div>
</div>
@endsection