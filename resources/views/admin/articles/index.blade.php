@extends('admin.layout')

@section('title', 'مدیریت مقالات')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-newspaper"></i> لیست مقالات</h5>
        <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus"></i> نوشتن مقاله جدید
        </a>
    </div>

    <div class="mb-3">
        <form method="GET" action="{{ route('admin.articles.index') }}" class="row g-2 align-items-center">
            <div class="col-auto">
                <select name="status" class="form-control form-control-sm" onchange="this.form.submit()">
                    <option value="">همه مقالات</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>✅ منتشر شده</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>📝 پیش‌نویس</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ در انتظار</option>
                </select>
            </div>
            <div class="col-auto">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="جستجوی مقاله..." value="{{ request('search') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">جستجو</button>
                <a href="{{ route('admin.articles.index') }}" class="btn btn-sm btn-secondary">حذف فیلتر</a>
            </div>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>عنوان</th>
                    <th>نویسنده</th>
                    <th>دسته</th>
                    <th>وضعیت</th>
                    <th>بازدید</th>
                    <th>تاریخ انتشار</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($articles as $article)
                    <tr>
                        <td>{{ $article->id }}</td>
                        <td>
                            @if($article->image)
                                <img src="{{ asset($article->image) }}" class="avatar-sm">
                            @else
                                <div class="avatar-sm" style="background:#e9ecef;display:flex;align-items:center;justify-content:center;font-size:20px;">📄</div>
                            @endif
                        </td>
                        <td><strong>{{ Str::limit($article->title, 40) }}</strong></td>
                        <td>{{ $article->author ?? 'نامشخص' }}</td>
                        <td>{{ $article->category ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $article->status_badge }}">
                                {{ $article->status_persian }}
                            </span>
                        </td>
                        <td>{{ number_format($article->views) }}</td>
                        <td>{{ $article->published_at ? $article->published_at->format('Y/m/d') : '-' }}</td>
                        <td>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-action edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($article->status == 'draft' || $article->status == 'pending')
                                <form action="{{ route('admin.articles.publish', $article->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-action" style="background:#28a745;color:white;" onclick="return confirm('آیا مقاله منتشر شود؟')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <a href="{{ route('articles.public.show', $article->slug) }}" target="_blank" class="btn-action view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" onclick="return confirm('آیا مطمئن هستید؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2" style="color:#ccc;"></i>
                            <span style="color:#6c757d;">هیچ مقاله‌ای یافت نشد</span>
                            <br>
                            <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary mt-2" style="display:inline-block;">
                                <i class="fas fa-plus"></i> اولین مقاله را بنویسید
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $articles->withQueryString()->links() }}
    </div>
</div>
@endsection