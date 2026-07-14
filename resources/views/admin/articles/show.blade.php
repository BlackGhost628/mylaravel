@extends('admin.layout')

@section('title', 'جزئیات مقاله')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-file-alt"></i> جزئیات مقاله</h5>
        <div>
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-action edit">
                <i class="fas fa-edit"></i> ویرایش
            </a>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-arrow-right"></i> بازگشت
            </a>
        </div>
    </div>

    <div style="max-width:800px;margin:0 auto;">
        @if($article->image)
            <div style="text-align:center;margin-bottom:20px;">
                <img src="{{ asset($article->image) }}" style="max-width:100%;max-height:300px;border-radius:12px;object-fit:cover;">
            </div>
        @endif

        <h2 style="font-size:24px;font-weight:700;color:var(--admin-secondary);">{{ $article->title }}</h2>

        <div style="display:flex;gap:20px;flex-wrap:wrap;margin:15px 0;color:#6c757d;font-size:14px;">
            <span><i class="fas fa-user"></i> {{ $article->author ?? 'نامشخص' }}</span>
            <span><i class="fas fa-tag"></i> {{ $article->category ?? 'بدون دسته' }}</span>
            <span><i class="fas fa-eye"></i> {{ number_format($article->views) }} بازدید</span>
            <span><i class="fas fa-calendar"></i> {{ $article->created_at->format('Y/m/d H:i') }}</span>
            <span>
                <span class="badge {{ $article->status_badge }}">
                    {{ $article->status_persian }}
                </span>
            </span>
        </div>

        @if($article->excerpt)
            <div style="background:#f8f9fa;padding:15px;border-radius:8px;border-right:4px solid var(--admin-primary);margin:15px 0;">
                <strong>خلاصه:</strong>
                <p style="margin:5px 0 0;">{{ $article->excerpt }}</p>
            </div>
        @endif

        <div style="background:white;padding:20px;border-radius:8px;border:1px solid #e9ecef;line-height:2.2;font-size:15px;">
            {!! nl2br(e($article->content)) !!}
        </div>

        <div style="margin-top:20px;padding-top:20px;border-top:1px solid #e9ecef;display:flex;gap:10px;">
            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-admin-primary">
                <i class="fas fa-edit"></i> ویرایش
            </a>
            
            @if($article->status != 'published')
                <form action="{{ route('admin.articles.publish', $article->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-action" style="background:#28a745;color:white;" onclick="return confirm('آیا مقاله منتشر شود؟')">
                        <i class="fas fa-check"></i> انتشار
                    </button>
                </form>
            @endif
            
            <a href="{{ route('articles.public.show', $article->slug) }}" target="_blank" class="btn-action view">
                <i class="fas fa-eye"></i> مشاهده در سایت
            </a>
        </div>
    </div>
</div>
@endsection