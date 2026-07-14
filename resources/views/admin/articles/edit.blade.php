@extends('admin.layout')

@section('title', 'ویرایش مقاله')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-edit"></i> ویرایش مقاله: {{ $article->title }}</h5>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-right"></i> بازگشت
        </a>
    </div>

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="form-admin">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">عنوان مقاله *</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" 
                   value="{{ old('title', $article->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="excerpt">خلاصه مقاله (چکیده)</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="form-control @error('excerpt') is-invalid @enderror">{{ old('excerpt', $article->excerpt) }}</textarea>
            @error('excerpt')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="content">متن مقاله *</label>
            <textarea name="content" id="content" rows="12" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">از تگ‌های HTML ساده مانند &lt;strong&gt;، &lt;em&gt;، &lt;ul&gt; و &lt;li&gt; استفاده کنید.</small>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="author">نام نویسنده</label>
                    <input type="text" name="author" id="author" class="form-control @error('author') is-invalid @enderror" 
                           value="{{ old('author', $article->author) }}">
                    @error('author')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category">دسته‌بندی</label>
                    <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" 
                           value="{{ old('category', $article->category) }}">
                    @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="image">تصویر شاخص</label>
            @if($article->image)
                <div class="mb-2">
                    <img src="{{ asset($article->image) }}" style="max-width:150px;border-radius:8px;border:2px solid #e9ecef;">
                    <br>
                    <small class="text-muted">تصویر فعلی</small>
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
            @error('image')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="text-muted">برای تغییر تصویر، فایل جدید را انتخاب کنید (JPEG, PNG, WebP - حداکثر ۲ مگابایت)</small>
        </div>

        <div class="form-group">
            <label for="status">وضعیت انتشار</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>📝 پیش‌نویس</option>
                <option value="pending" {{ old('status', $article->status) == 'pending' ? 'selected' : '' }}>⏳ در انتظار بررسی</option>
                <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>✅ منتشر شده</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" class="btn-admin-primary">
                <i class="fas fa-save"></i> بروزرسانی مقاله
            </button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">انصراف</a>
        </div>
    </form>
</div>
@endsection