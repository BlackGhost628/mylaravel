@extends('layouts.app')

{{-- ===== متاتگ‌های سئو ===== --}}
@section('title', 'مقالات - FoodEase')
@section('description', 'مطالعه جدیدترین مقالات آموزشی و خبری در مورد غذا، آشپزی و رستوران‌ها')
@section('keywords', 'مقالات, آموزش آشپزی, رستوران, غذا, سلامت, تغذیه')
@section('og_title', 'مقالات - FoodEase')
@section('og_description', 'مطالعه جدیدترین مقالات آموزشی و خبری در مورد غذا، آشپزی و رستوران‌ها')
@section('og_image', asset('image/articles-banner.jpg'))

@section('styles')
<style>
    .article-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 25px;
    }

    .article-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #e9ecef;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .article-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    }
    .article-card img {
        width: 100%;
        height: 190px;
        object-fit: cover;
    }
    .article-card .body {
        padding: 16px 18px 18px;
    }
    .article-card .body h3 {
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 8px;
        color: #1f2937;
        line-height: 1.4;
    }
    .article-card .body h3 a {
        color: inherit;
        text-decoration: none;
        transition: color 0.2s;
    }
    .article-card .body h3 a:hover {
        color: #FF385C;
    }
    .article-card .body .excerpt {
        font-size: 14px;
        color: #6b7280;
        margin: 0 0 12px;
        line-height: 1.7;
        height: 44px;
        overflow: hidden;
    }
    .article-card .body .meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 13px;
        color: #adb5bd;
        border-top: 1px solid #f1f3f5;
        padding-top: 12px;
    }
    .article-card .body .meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }
    .article-card .body .read-more {
        display: inline-block;
        margin-top: 12px;
        color: #FF385C;
        font-weight: 600;
        font-size: 14px;
        text-decoration: none;
        transition: color 0.2s;
    }
    .article-card .body .read-more:hover {
        color: #e62e4f;
    }
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }
    .empty-state .icon {
        font-size: 48px;
        margin-bottom: 15px;
    }
    .empty-state h3 {
        font-size: 20px;
        color: #2D2D2D;
        margin: 0 0 8px;
    }
    .empty-state p {
        margin: 0;
    }
    .empty-state a {
        color: #FF385C;
        text-decoration: none;
        font-weight: 600;
    }
    .no-image-placeholder {
        width: 100%;
        height: 190px;
        background: #f8f9fa;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #adb5bd;
        font-size: 48px;
    }
</style>
@endsection

@section('content')
<div style="max-width:1000px;margin:0 auto;padding:20px;">

    {{-- عنوان --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:15px;margin-bottom:20px;">
        <h1 style="font-size:28px;font-weight:700;color:#2D2D2D;margin:0;">📰 مقالات</h1>
        <span style="color:#6c757d;font-size:14px;">{{ $articles->total() }} مقاله</span>
    </div>

    {{-- ===== نوار جستجوی پیشرفته ===== --}}
    @include('partials.search-bar', [
        'route' => route('articles.public.index'),
        'placeholder' => 'عنوان یا محتوا...',
        'categories' => $categories ?? [],
        'showCategory' => true,
        'showSort' => true,
        'showPrice' => false,
        'showFeatured' => false,
    ])

    {{-- ===== گرید مقالات ===== --}}
    <div class="article-grid">
        @forelse($articles as $article)
            <article class="article-card">
                @if($article->image)
                    <img src="{{ asset($article->image) }}" alt="{{ $article->title }}">
                @else
                    <div class="no-image-placeholder">📄</div>
                @endif

                <div class="body">
                    <h3>
                        <a href="{{ route('articles.public.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    
                    @if($article->excerpt)
                        <p class="excerpt">{{ Str::limit($article->excerpt, 100) }}</p>
                    @endif

                    <div class="meta">
                        <span>✍️ {{ $article->author ?? 'نامشخص' }}</span>
                        <span>📅 {{ $article->published_at ? $article->published_at->format('Y/m/d') : '-' }}</span>
                    </div>

                    <a href="{{ route('articles.public.show', $article->slug) }}" class="read-more">
                        مطالعه بیشتر →
                    </a>
                </div>
            </article>
        @empty
            <div class="empty-state">
                <div class="icon">📭</div>
                <h3>هیچ مقاله‌ای یافت نشد</h3>
                <p>با فیلترهای دیگر جستجو کنید یا <a href="{{ route('articles.public.index') }}">همه مقالات</a> را ببینید.</p>
            </div>
        @endforelse
    </div>

    {{-- ===== صفحه‌بندی ===== --}}
    <div style="margin-top:35px;">
        {{ $articles->links() }}
    </div>
</div>
@endsection