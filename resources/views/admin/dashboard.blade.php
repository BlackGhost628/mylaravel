@extends('admin.layout')

@section('title', 'داشبورد')

@section('content')
<div class="row g-4">
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon primary"><i class="fas fa-utensils"></i></div>
            <h3>{{ $totalProducts }}</h3>
            <div class="label">محصولات</div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon success"><i class="fas fa-shopping-bag"></i></div>
            <h3>0</h3>
            <div class="label">سفارش‌ها</div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon warning"><i class="fas fa-envelope"></i></div>
            <h3>{{ $totalContacts }}</h3>
            <div class="label">پیام‌ها</div>
            @if($unreadContacts > 0)
                <span class="badge bg-danger">{{ $unreadContacts }} جدید</span>
            @endif
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="stat-card">
            <div class="icon info"><i class="fas fa-users"></i></div>
            <h3>0</h3>
            <div class="label">کاربران</div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="table-container">
            <div class="table-header">
                <h5>آخرین محصولات اضافه شده</h5>
            </div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>تصویر</th>
                        <th>نام</th>
                        <th>قیمت</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentProducts as $product)
                        <tr>
                            <td><img src="{{ $product->image_url }}" class="avatar-sm"></td>
                            <td>{{ $product->name }}</td>
                            <td>{{ number_format($product->price) }} تومان</td>
                            <td>{{ $product->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">هیچ محصولی یافت نشد</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="table-container">
            <div class="table-header">
                <h5>آخرین پیام‌ها</h5>
            </div>
            <table class="table-admin">
                <thead>
                    <tr>
                        <th>نام</th>
                        <th>موضوع</th>
                        <th>وضعیت</th>
                        <th>تاریخ</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentContacts as $contact)
                        <tr>
                            <td>{{ $contact->name }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>
                                @if($contact->is_read)
                                    <span class="badge bg-success">خوانده شده</span>
                                @else
                                    <span class="badge bg-danger">جدید</span>
                                @endif
                            </td>
                            <td>{{ $contact->created_at->format('Y/m/d') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">هیچ پیامی یافت نشد</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection