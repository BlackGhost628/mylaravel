@extends('admin.layout')

@section('title', 'نظرات در انتظار تایید')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-clock"></i> نظرات در انتظار تایید</h5>
        <a href="{{ route('admin.comments.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-list"></i> همه نظرات
        </a>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>کاربر</th>
                    <th>مقاله</th>
                    <th>نظر</th>
                    <th>تاریخ</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @forelse($comments as $comment)
                    <tr>
                        <td>{{ $comment->id }}</td>
                        <td>
                            <strong>{{ $comment->user->name ?? 'نامشخص' }}</strong>
                            <br>
                            <small style="color:#6c757d;">{{ $comment->user->email ?? '' }}</small>
                        </td>
                        <td>
                            <a href="{{ route('admin.articles.show', $comment->article_id) }}" style="color:#FF385C;">
                                {{ Str::limit($comment->article->title ?? 'بدون عنوان', 30) }}
                            </a>
                        </td>
                        <td>{{ Str::limit($comment->content, 50) }}</td>
                        <td>{{ $comment->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-action" style="background:#28a745;color:white;" onclick="return confirm('تایید شود؟')">
                                    <i class="fas fa-check"></i> تایید
                                </button>
                            </form>
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" onclick="return confirm('حذف شود؟')">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x d-block mb-2" style="color:#28a745;"></i>
                            <span style="color:#6c757d;">همه نظرات تایید شده‌اند!</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $comments->links() }}
    </div>
</div>
@endsection