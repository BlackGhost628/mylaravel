@extends('layouts.app')

@section('title', $product->name . ' - FoodEase')

@section('content')
<div class="max-w-5xl mx-auto py-8">

    <div class="bg-white rounded-2xl shadow-md border border-gray-100 p-6 md:p-8">
        <div class="flex flex-col md:flex-row gap-8">

            {{-- تصویر --}}
            <div class="md:w-1/2">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" 
                     class="w-full rounded-xl object-cover shadow-sm">
            </div>

            {{-- اطلاعات --}}
            <div class="md:w-1/2 space-y-4">
                <h1 class="text-3xl font-bold text-gray-800">{{ $product->name }}</h1>

                <div>
                    <span class="inline-block bg-gray-100 text-gray-700 px-4 py-1 rounded-full text-sm font-medium">
                        دسته: 
                        @switch($product->category)
                            @case('pizza') 🍕 پیتزا @break
                            @case('kebab') 🥩 کباب @break
                            @case('salad') 🥗 سالاد @break
                            @case('pasta') 🍝 پاستا @break
                            @default {{ $product->category }}
                        @endswitch
                    </span>
                </div>

                <div class="text-3xl font-bold text-[#FF385C]">
                    {{ $product->formatted_price }}
                </div>

                <div class="prose max-w-none text-gray-600 leading-relaxed">
                    <p class="font-semibold text-gray-700">توضیحات:</p>
                    <p>{{ $product->description }}</p>
                </div>

                <div class="flex flex-wrap gap-3 pt-2">
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <x-button type="submit" variant="primary" size="lg">
                            🛒 افزودن به سبد خرید
                        </x-button>
                    </form>
                    <x-button href="{{ route('products') }}" variant="outline" size="lg">
                        ← بازگشت به منو
                    </x-button>
                </div>

                <div class="flex gap-6 text-sm text-gray-500 pt-2 border-t border-gray-100">
                    <span>⭐ امتیاز: {{ $product->rating }}/5</span>
                    <span>❤️ {{ $product->likes }} لایک</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection