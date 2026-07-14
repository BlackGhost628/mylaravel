@extends('layouts.guest')

@section('title', 'ثبت‌نام - FoodEase')

@section('content')
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        {{-- نام --}}
        <div class="form-group">
            <label for="name">نام کامل</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" 
                   class="form-control @error('name') is-invalid @enderror"
                   placeholder="علی رضایی" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- ایمیل --}}
        <div class="form-group">
            <label for="email">ایمیل</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="example@email.com" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- تلفن (اختیاری) --}}
        <div class="form-group">
            <label for="phone">شماره تلفن (اختیاری)</label>
            <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" 
                   class="form-control @error('phone') is-invalid @enderror"
                   placeholder="09123456789">
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- رمز عبور --}}
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input id="password" type="password" name="password" 
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="حداقل ۸ کاراکتر" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- تکرار رمز عبور --}}
        <div class="form-group">
            <label for="password_confirmation">تکرار رمز عبور</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="form-control"
                   placeholder="تکرار رمز عبور" required>
        </div>

        {{-- دکمه ثبت‌نام --}}
        <button type="submit" class="btn-primary">ثبت‌نام</button>

        {{-- لینک‌ها --}}
        <div class="auth-links">
            <p>
                قبلاً حساب دارید؟ 
                <a href="{{ route('login') }}">ورود</a>
            </p>
        </div>
    </form>
@endsection