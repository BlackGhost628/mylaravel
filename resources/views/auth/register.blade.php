@extends('layouts.guest')

@section('title', 'ثبت‌نام - FoodEase')

@section('content')
<form method="POST" action="{{ route('register') }}" class="space-y-4">
    @csrf

    <x-input name="name" label="نام کامل" type="text" placeholder="علی رضایی" required />
    <x-input name="email" label="ایمیل" type="email" placeholder="example@email.com" required />
    <x-input name="phone" label="شماره تلفن (اختیاری)" type="tel" placeholder="09123456789" />
    <x-input name="password" label="رمز عبور" type="password" placeholder="حداقل ۸ کاراکتر" required />
    <x-input name="password_confirmation" label="تکرار رمز عبور" type="password" placeholder="تکرار رمز عبور" required />

    <div class="flex items-center gap-2">
        <input type="checkbox" name="terms" id="terms" required class="w-4 h-4 accent-[#FF385C]">
        <label for="terms" class="text-sm text-gray-600 cursor-pointer">قوانین و شرایط سایت را می‌پذیرم</label>
    </div>

    <x-button type="submit" variant="primary" size="lg" class="w-full">ثبت‌نام</x-button>

    <div class="text-center text-sm text-gray-500 mt-4">
        <p>
            قبلاً حساب دارید؟
            <a href="{{ route('login') }}" class="text-[#FF385C] font-semibold hover:underline">ورود</a>
        </p>
    </div>
</form>
@endsection