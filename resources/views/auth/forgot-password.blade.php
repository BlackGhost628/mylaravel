@extends('layouts.guest')

@section('title', 'بازیابی رمز عبور - FoodEase')

@section('content')
<div class="text-center text-sm text-gray-500 mb-4">
    رمز عبور خود را فراموش کرده‌اید؟ ایمیل خود را وارد کنید تا لینک بازیابی برای شما ارسال شود.
</div>

<form method="POST" action="{{ route('password.email') }}" class="space-y-4">
    @csrf

    <x-input name="email" label="ایمیل" type="email" placeholder="example@email.com" required />

    <x-button type="submit" variant="primary" size="lg" class="w-full">ارسال لینک بازیابی</x-button>

    <div class="text-center text-sm text-gray-500 mt-4">
        <a href="{{ route('login') }}" class="text-[#FF385C] font-semibold hover:underline">← بازگشت به ورود</a>
    </div>
</form>
@endsection