@extends('layouts.guest')

@section('title', 'ورود - FoodEase')

@section('content')
<form method="POST" action="{{ route('login') }}" class="space-y-4">
    @csrf

    <x-input name="email" label="ایمیل" type="email" placeholder="example@email.com" required />
    <x-input name="password" label="رمز عبور" type="password" placeholder="••••••••" required />

    <div class="flex items-center gap-2">
        <input type="checkbox" name="remember" id="remember" class="w-4 h-4 accent-[#FF385C]">
        <label for="remember" class="text-sm text-gray-600 cursor-pointer">مرا به خاطر بسپار</label>
    </div>

    <x-button type="submit" variant="primary" size="lg" class="w-full">ورود</x-button>

    <div class="text-center text-sm text-gray-500 space-y-2 mt-4">
        <p>
            رمز خود را فراموش کردید؟
            <a href="{{ route('password.request') }}" class="text-[#FF385C] font-semibold hover:underline">بازیابی رمز</a>
        </p>
        <p>
            حساب ندارید؟
            <a href="{{ route('register') }}" class="text-[#FF385C] font-semibold hover:underline">ثبت‌نام کنید</a>
        </p>
    </div>
</form>
@endsection