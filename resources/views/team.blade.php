@extends('layouts.app')

@section('title', 'تیم ما - FoodEase')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-12">

    {{-- عنوان صفحه --}}
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800">👥 تیم ما</h1>
        <p class="text-gray-500 mt-2 text-lg">افرادی که FoodEase را می‌سازند</p>
    </div>

    {{-- شبکه کارت‌ها --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 justify-items-center">

        {{-- کارت ۱ --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 p-6 text-center w-full max-w-[230px]">
            <div class="relative mx-auto w-32 h-32 mb-4">
                <img src="{{ asset('image/milad.jpg') }}" alt="Milad" 
                     class="w-full h-full object-cover rounded-full border-4 border-[#FF385C] shadow-lg">
            </div>
            <h3 class="text-xl font-bold text-gray-800">میلاد</h3>
            <p class="text-sm text-gray-500 mt-1">مدیر پروژه</p>
            <div class="flex justify-center gap-3 mt-4">
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-github"></i></a>
            </div>
        </div>

        {{-- کارت ۲ --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 p-6 text-center w-full max-w-[230px]">
            <div class="relative mx-auto w-32 h-32 mb-4">
                <img src="{{ asset('image/sara.jpg') }}" alt="Sara" 
                     class="w-full h-full object-cover rounded-full border-4 border-[#FF385C] shadow-lg">
            </div>
            <h3 class="text-xl font-bold text-gray-800">سارا محمدی</h3>
            <p class="text-sm text-gray-500 mt-1">طراح رابط کاربری</p>
            <div class="flex justify-center gap-3 mt-4">
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-dribbble"></i></a>
            </div>
        </div>

        {{-- کارت ۳ --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 p-6 text-center w-full max-w-[230px]">
            <div class="relative mx-auto w-32 h-32 mb-4">
                <img src="{{ asset('image/amirreza.jpg') }}" alt="Amirreza" 
                     class="w-full h-full object-cover rounded-full border-4 border-[#FF385C] shadow-lg">
            </div>
            <h3 class="text-xl font-bold text-gray-800">امیررضا نادری</h3>
            <p class="text-sm text-gray-500 mt-1">توسعه‌دهنده بک‌اند</p>
            <div class="flex justify-center gap-3 mt-4">
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-github"></i></a>
            </div>
        </div>

        {{-- کارت ۴ --}}
        <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 p-6 text-center w-full max-w-[230px]">
            <div class="relative mx-auto w-32 h-32 mb-4">
                <img src="{{ asset('image/nazanin.jpg') }}" alt="Nazanin" 
                     class="w-full h-full object-cover rounded-full border-4 border-[#FF385C] shadow-lg">
            </div>
            <h3 class="text-xl font-bold text-gray-800">نازنین احمدی</h3>
            <p class="text-sm text-gray-500 mt-1">پشتیبانی و محتوا</p>
            <div class="flex justify-center gap-3 mt-4">
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" class="text-gray-400 hover:text-[#FF385C] transition"><i class="fab fa-instagram"></i></a>
            </div>
        </div>

    </div>

    {{-- توضیحات تیم --}}
    <div class="mt-16 text-center bg-gray-50 rounded-2xl p-8 border border-gray-200">
        <h2 class="text-2xl font-bold text-gray-800">ما با هم می‌سازیم</h2>
        <p class="text-gray-600 max-w-2xl mx-auto mt-2">
            تیم FoodEase متشکل از متخصصان با تجربه در حوزه‌های طراحی، توسعه و مدیریت است.
            هدف ما ارائه بهترین تجربه سفارش غذا به شماست.
        </p>
    </div>
</div>
@endsection