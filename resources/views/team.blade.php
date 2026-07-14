@extends('layouts.app')

@section('title', 'تیم ما - FoodEase')

@section('styles')
<style>
    .team-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 35px;
        margin-top: 40px;
    }

    .member-card {
        width: 230px;
        text-align: center;
        background: var(--md-sys-color-surface-container);
        border-radius: 18px;
        padding: 25px 15px;
        box-shadow: 0 5px 18px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s ease;
    }

    .member-card:hover {
        transform: translateY(-7px);
    }

    .member-card img {
        width: 140px;
        height: 140px;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--md-sys-color-primary);
        margin-bottom: 12px;
    }

    .member-card h3 {
        font-size: 18px;
        color: var(--md-sys-color-primary);
        margin: 8px 0 4px;
    }

    .member-card p {
        font-size: 14px;
        color: var(--md-sys-color-on-surface);
        margin: 0;
    }
</style>
@endsection

@section('content')
<section class="team-container">
    <article class="md-card md-card-elevated member-card">
        <img src="{{ asset('image/milad.jpg') }}" alt="Milad">
        <h3>میلاد</h3>
        <p>مدیر پروژه</p>
    </article>

    <article class="md-card md-card-elevated member-card">
        <img src="{{ asset('image/sara.jpg') }}" alt="Sara">
        <h3>سارا محمدی</h3>
        <p>طراح رابط کاربری</p>
    </article>

    <article class="md-card md-card-elevated member-card">
        <img src="{{ asset('image/amirreza.jpg') }}" alt="Amirreza">
        <h3>امیررضا نادری</h3>
        <p>توسعه‌دهنده بک‌اند</p>
    </article>

    <article class="md-card md-card-elevated member-card">
        <img src="{{ asset('image/nazanin.jpg') }}" alt="Nazanin">
        <h3>نازنین احمدی</h3>
        <p>پشتیبانی و محتوا</p>
    </article>
</section>
@endsection