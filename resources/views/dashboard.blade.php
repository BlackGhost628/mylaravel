@extends('layouts.app')

@section('title', 'داشبورد')

@section('content')
    <div style="text-align:center;padding:40px 0;">
        <h1 style="color:#FF385C;font-size:28px;">🎉 به داشبورد خوش آمدید!</h1>
        <p style="color:#6b7280;font-size:16px;margin-top:10px;">{{ Auth::user()->name }} عزیز، به پنل کاربری خود خوش آمدید.</p>
        
        <div style="display:flex;gap:20px;justify-content:center;flex-wrap:wrap;margin-top:30px;">
            <a href="{{ route('orders.index') }}" style="background:#FF385C;color:white;padding:15px 25px;border-radius:12px;text-decoration:none;">
                📦 سفارش‌های من
            </a>
            <a href="{{ route('profile.edit') }}" style="background:#2D2D2D;color:white;padding:15px 25px;border-radius:12px;text-decoration:none;">
                👤 ویرایش پروفایل
            </a>
            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" style="background:#28a745;color:white;padding:15px 25px;border-radius:12px;text-decoration:none;">
                    ⚙️ پنل مدیریت
                </a>
            @endif
        </div>
    </div>
@endsection