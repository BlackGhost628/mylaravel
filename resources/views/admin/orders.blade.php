@extends('admin.layout')

@section('title', 'مدیریت سفارش‌ها')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-shopping-bag"></i> لیست سفارش‌ها</h5>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>شماره سفارش</th>
                    <th>کاربر</th>
                    <th>مبلغ کل</th>
                    <th>وضعیت سفارش</th>
                    <th>وضعیت پرداخت</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td><strong>{{ $order->order_number }}</strong></td>
                        <td>{{ $order->user->name ?? 'نامشخص' }}</td>
                        <td>{{ number_format($order->total_price) }} تومان</td>
                        <td>
                            <span class="badge {{ $order->status_badge ?? 'bg-secondary' }}">
                                {{ $order->status_persian ?? $order->status }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $order->payment_status_badge ?? 'bg-secondary' }}">
                                {{ $order->payment_status_persian ?? $order->payment_status }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.orders.delete', $order->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" onclick="return confirm('آیا مطمئن هستید؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2" style="color:#ccc;"></i>
                            <span style="color:#6c757d;">هیچ سفارشی یافت نشد</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $orders->links() }}
    </div>
</div>
@endsection