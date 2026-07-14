@extends('layouts.guest')

@section('title', 'ورود - FoodEase')

@section('content')
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        {{-- ایمیل --}}
        <div class="form-group">
            <label for="email">ایمیل</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" 
                   class="form-control @error('email') is-invalid @enderror"
                   placeholder="example@email.com" required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- رمز عبور --}}
        <div class="form-group">
            <label for="password">رمز عبور</label>
            <input id="password" type="password" name="password" 
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="••••••••" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- مرا به خاطر بسپار --}}
        <div class="checkbox-group">
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">مرا به خاطر بسپار</label>
        </div>

        {{-- دکمه ورود --}}
        <button type="submit" class="btn-primary">ورود</button>

        {{-- لینک‌ها --}}
        <div class="auth-links">
            <p>
                رمز خود را فراموش کردید؟ 
                <a href="{{ route('password.request') }}">بازیابی رمز</a>
            </p>
            <p>
                حساب ندارید؟ 
                <a href="{{ route('register') }}">ثبت‌نام کنید</a>
            </p>
        </div>
    </form>
@endsection