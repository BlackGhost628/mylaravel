@extends('admin.layout')

@section('title', 'مقالات در انتظار بررسی')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-clock"></i> مقالات در انتظار بررسی</h5>
        <div>
            <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary">
                <i class="fas fa-plus"></i> نوشتن مقاله جدید
            </a>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary btn-sm">
                <i class="fas fa-list"></i> همه مقالات
            </a>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="stat-card" style="border-right-color: #ffc107;">
                <div class="icon warning"><i class="fas fa-pen"></i></div>
                <h3>{{ \App\Models\Article::draft()->count() }}</h3>
                <div class="label">پیش‌نویس</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-right-color: #17a2b8;">
                <div class="icon info"><i class="fas fa-clock"></i></div>
                <h3>{{ \App\Models\Article::pending()->count() }}</h3>
                <div class="label">در انتظار بررسی</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card" style="border-right-color: #28a745;">
                <div class="icon success"><i class="fas fa-check-circle"></i></div>
                <h3>{{ \App\Models\Article::published()->count() }}</h3>
                <div class="label">منتشر شده</div>
            </div>
        </div>
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
                    <th>تاریخ</th>
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
                        <td>{{ $article->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn-action edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            
                            <form action="{{ route('admin.articles.publish', $article->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-action" style="background:#28a745;color:white;" onclick="return confirm('آیا مقاله منتشر شود؟')">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            
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
                        <td colspan="8" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2" style="color:#ccc;"></i>
                            <span style="color:#6c757d;">هیچ مقاله‌ای در انتظار بررسی نیست</span>
                            <br>
                            <a href="{{ route('admin.articles.create') }}" class="btn-admin-primary mt-2" style="display:inline-block;">
                                <i class="fas fa-plus"></i> نوشتن مقاله جدید
                            </a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $articles->links() }}
    </div>
</div>
@endsection