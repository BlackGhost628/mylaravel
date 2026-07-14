@extends('layouts.app')

@section('title', $article->title . ' - FoodEase')

@section('content')
<div style="max-width:800px;margin:0 auto;padding:20px;">

    {{-- عنوان مقاله --}}
    <h1 style="font-size:28px;font-weight:700;color:#2D2D2D;margin-bottom:15px;">{{ $article->title }}</h1>
    
    {{-- اطلاعات مقاله --}}
    <div style="display:flex;gap:20px;flex-wrap:wrap;margin-bottom:20px;color:#6c757d;font-size:14px;border-bottom:1px solid #e9ecef;padding-bottom:15px;">
        <span>✍️ نویسنده: {{ $article->author ?? 'نامشخص' }}</span>
        <span>📅 تاریخ انتشار: {{ $article->published_at ? $article->published_at->format('Y/m/d') : 'تاریخ نامشخص' }}</span>
        <span>👁️ {{ number_format($article->views) }} بازدید</span>
        @if($article->category)
            <span>🏷️ دسته: {{ $article->category }}</span>
        @endif
        <span>💬 {{ $article->approved_comments_count }} نظر</span>
    </div>

    {{-- تصویر شاخص --}}
    @if($article->image)
        <div style="margin-bottom:20px;">
            <img src="{{ asset($article->image) }}" alt="{{ $article->title }}" style="width:100%;max-height:400px;object-fit:cover;border-radius:12px;">
        </div>
    @endif

    {{-- خلاصه --}}
    @if($article->excerpt)
        <div style="background:#f8f9fa;padding:15px 20px;border-radius:8px;border-right:4px solid #FF385C;margin-bottom:25px;">
            <strong style="color:#FF385C;">خلاصه:</strong>
            <p style="margin:5px 0 0;color:#495057;">{{ $article->excerpt }}</p>
        </div>
    @endif

    {{-- محتوای اصلی --}}
    <div style="background:white;padding:25px;border-radius:12px;border:1px solid #e9ecef;line-height:2.2;font-size:16px;color:#2D2D2D;">
        {!! nl2br(e($article->content)) !!}
    </div>

    {{-- ========== بخش نظرات ========== --}}
    <div style="margin-top:40px;padding-top:30px;border-top:2px solid #e9ecef;">

        {{-- عنوان بخش نظرات --}}
        <h3 style="font-size:20px;font-weight:700;color:#2D2D2D;margin-bottom:20px;">
            💬 نظرات ({{ $article->approved_comments_count }})
        </h3>

        {{-- فرم ثبت نظر (فقط کاربران لاگین شده) --}}
        @auth
            <div style="background:#f8f9fa;padding:20px;border-radius:12px;margin-bottom:25px;">
                <h4 style="font-size:16px;font-weight:600;color:#2D2D2D;margin-bottom:12px;">نظر خود را بنویسید</h4>
                
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    
                    <textarea name="content" rows="4" 
                              style="width:100%;padding:12px 15px;border:2px solid #d1d5db;border-radius:10px;font-size:14px;box-sizing:border-box;resize:vertical;"
                              placeholder="نظر خود را بنویسید..." required></textarea>
                    
                    <button type="submit" 
                            style="margin-top:12px;padding:10px 25px;background:#FF385C;color:white;border:none;border-radius:10px;font-weight:600;cursor:pointer;">
                        ارسال نظر
                    </button>
                </form>
            </div>
        @else
            <div style="background:#f8f9fa;padding:15px 20px;border-radius:12px;text-align:center;margin-bottom:25px;color:#6b7280;">
                برای ثبت نظر، ابتدا 
                <a href="{{ route('login') }}" style="color:#FF385C;font-weight:600;">وارد</a> 
                شوید یا 
                <a href="{{ route('register') }}" style="color:#FF385C;font-weight:600;">ثبت‌نام</a> 
                کنید.
            </div>
        @endauth

        {{-- نمایش پیام‌ها --}}
        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:12px 15px;border-radius:10px;margin-bottom:20px;border-right:4px solid #28a745;">
                {{ session('success') }}
            </div>
        @endif

        {{-- لیست نظرات --}}
        @if($article->approvedComments()->count() > 0)
            <div style="space-y:20px;">
                @foreach($article->approvedComments as $comment)
                    <div style="background:white;padding:15px 20px;border-radius:12px;border:1px solid #e9ecef;margin-bottom:15px;">
                        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;margin-bottom:8px;">
                            <div>
                                <strong style="color:#2D2D2D;">{{ $comment->user->name ?? 'کاربر ناشناس' }}</strong>
                                <span style="color:#adb5bd;font-size:13px;margin-right:10px;">
                                    {{ $comment->created_at->format('Y/m/d H:i') }}
                                </span>
                            </div>
                            
                            @auth
                                @if($comment->user_id == Auth::id())
                                    <form action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                style="background:none;border:none;color:#dc3545;cursor:pointer;font-size:13px;"
                                                onclick="return confirm('آیا مطمئن هستید؟')">
                                            🗑️ حذف
                                        </button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        
                        <p style="margin:0;color:#495057;line-height:1.8;font-size:15px;">
                            {{ $comment->content }}
                        </p>
                    </div>
                @endforeach
            </div>
        @else
            <div style="text-align:center;padding:30px 20px;color:#adb5bd;">
                <div style="font-size:32px;margin-bottom:10px;">💭</div>
                <p style="margin:0;">هنوز نظری ثبت نشده است. اولین نفری باشید که نظر می‌دهد!</p>
            </div>
        @endif
    </div>

    {{-- دکمه بازگشت --}}
    <div style="margin-top:30px;padding-top:20px;border-top:1px solid #e9ecef;">
        <a href="{{ route('articles.public.index') }}" style="display:inline-block;color:#FF385C;text-decoration:none;font-weight:600;">
            ← بازگشت به لیست مقالات
        </a>
    </div>
</div>
@endsection