@extends('layouts.app')

@section('title', 'تماس با ما - FoodEase')

@section('styles')
<style>
    form {
        background: var(--md-sys-color-surface-container-high);
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        max-width: 520px;
        width: 90%;
        margin: 30px auto;
    }

    form label {
        display: block;
        margin-top: 15px;
        font-weight: 600;
        color: var(--md-sys-color-on-surface);
    }

    input, textarea {
        width: 100%;
        padding: 10px;
        margin-top: 8px;
        border: 1px solid var(--md-sys-color-outline);
        border-radius: 6px;
        font-size: 14px;
        background-color: var(--md-sys-color-surface);
        color: var(--md-sys-color-on-surface);
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        max-width: 520px;
        margin: 20px auto;
        text-align: center;
    }

    .alert-error {
        background: #f8d7da;
        color: #721c24;
        padding: 12px;
        border-radius: 8px;
        margin-bottom: 20px;
        max-width: 520px;
        margin: 20px auto;
        text-align: center;
    }

    .error-text {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }
</style>
@endsection

@section('content')
@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@if($errors->any())
    <div class="alert-error">
        <ul style="list-style:none;padding:0;margin:0;">
            @foreach($errors->all() as $error)
                <li>❌ {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<section class="md-card md-card-elevated" style="max-width:520px;margin:40px auto;padding:32px;">
    <h2 style="text-align:center;margin-bottom:24px;">تماس با ما</h2>

    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        
        <label for="fullname">نام و نام خانوادگی *</label>
        <input type="text" id="fullname" name="fullname" placeholder="نام کامل خود را وارد کنید" value="{{ old('fullname') }}" required>
        @error('fullname') <div class="error-text">{{ $message }}</div> @enderror

        <label for="email">ایمیل *</label>
        <input type="email" id="email" name="email" placeholder="example@email.com" value="{{ old('email') }}" required>
        @error('email') <div class="error-text">{{ $message }}</div> @enderror

        <label for="subject">موضوع پیام *</label>
        <input type="text" id="subject" name="subject" placeholder="موضوع پیام" value="{{ old('subject') }}" required>
        @error('subject') <div class="error-text">{{ $message }}</div> @enderror

        <label for="message">متن پیام *</label>
        <textarea id="message" name="message" rows="5" placeholder="پیام خود را بنویسید..." required>{{ old('message') }}</textarea>
        @error('message') <div class="error-text">{{ $message }}</div> @enderror

        <div style="text-align:center;margin-top:20px;">
            <button type="submit" class="md-btn md-filled md-md">ارسال پیام</button>
        </div>
    </form>
</section>
@endsection