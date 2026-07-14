@extends('admin.layout')

@section('title', 'جزئیات پیام')

@section('content')
    <h2>جزئیات پیام</h2>
    
    <div style="max-width:600px;">
        <p><strong>نام:</strong> {{ $contact->name }}</p>
        <p><strong>ایمیل:</strong> {{ $contact->email }}</p>
        <p><strong>موضوع:</strong> {{ $contact->subject }}</p>
        <p><strong>تاریخ:</strong> {{ $contact->created_at->format('Y/m/d H:i') }}</p>
        <p><strong>پیام:</strong></p>
        <div style="background:var(--md-sys-color-surface-container);padding:15px;border-radius:8px;">
            {{ $contact->message }}
        </div>
    </div>
    
    <a href="{{ route('admin.contacts') }}" class="btn-primary" style="margin-top:20px;display:inline-block;">← بازگشت</a>
@endsection