@extends('layouts.guest')

@section('title', 'بازیابی رمز عبور - FoodEase')

@section('content')
    <div style="margin-bottom:20px;color:#6b7280;font-size:14px;text-align:center;">
        رمز عبور خود را فراموش کرده‌اید؟ ایمیل خود را وارد کنید تا لینک بازیابی برای شما ارسال شود.
    </div>

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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

        {{-- دکمه ارسال --}}
        <button type="submit" class="btn-primary">ارسال لینک بازیابی</button>

        {{-- لینک بازگشت --}}
        <div class="auth-links">
            <p>
                <a href="{{ route('login') }}">← بازگشت به ورود</a>
            </p>
        </div>
    </form>
@endsection