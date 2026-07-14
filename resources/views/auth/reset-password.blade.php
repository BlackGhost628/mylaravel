@extends('layouts.guest')

@section('title', 'تنظیم رمز جدید - FoodEase')

@section('content')
    <div style="margin-bottom:20px;color:#6b7280;font-size:14px;text-align:center;">
        رمز عبور جدید خود را وارد کنید.
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        {{-- توکن بازیابی --}}
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        {{-- ایمیل --}}
        <div class="form-group">
            <label for="email">ایمیل</label>
            <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" 
                   class="form-control @error('email') is-invalid @enderror"
                   required autofocus>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- رمز جدید --}}
        <div class="form-group">
            <label for="password">رمز عبور جدید</label>
            <input id="password" type="password" name="password" 
                   class="form-control @error('password') is-invalid @enderror"
                   placeholder="حداقل ۸ کاراکتر" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- تکرار رمز --}}
        <div class="form-group">
            <label for="password_confirmation">تکرار رمز عبور</label>
            <input id="password_confirmation" type="password" name="password_confirmation" 
                   class="form-control"
                   placeholder="تکرار رمز عبور" required>
        </div>

        {{-- دکمه ذخیره --}}
        <button type="submit" class="btn-primary">ذخیره رمز جدید</button>

        {{-- لینک بازگشت --}}
        <div class="auth-links">
            <p>
                <a href="{{ route('login') }}">← بازگشت به ورود</a>
            </p>
        </div>
    </form>
@endsection