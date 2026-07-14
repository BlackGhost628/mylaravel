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
                    <th>وضعیت</th>
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
                            <span class="badge bg-warning">{{ $order->status }}</span>
                        </td>
                        <td>{{ $order->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn-action view">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">هیچ سفارشی یافت نشد</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    {{ $orders->links() }}
</div>
@endsection