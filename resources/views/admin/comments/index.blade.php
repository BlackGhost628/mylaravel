@extends('admin.layout')

@section('title', 'مدیریت نظرات')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-comments"></i> لیست نظرات</h5>
        <a href="{{ route('admin.comments.pending') }}" class="btn btn-warning btn-sm">
            <i class="fas fa-clock"></i> نظرات در انتظار تایید
            @php
                $pendingCount = \App\Models\Comment::where('is_approved', false)->count();
            @endphp
            @if($pendingCount > 0)
                <span class="badge bg-danger">{{ $pendingCount }}</span>
            @endif
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
                    <th>وضعیت</th>
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
                        <td>
                            @if($comment->is_approved)
                                <span class="badge bg-success">✅ تایید شده</span>
                            @else
                                <span class="badge bg-warning">⏳ در انتظار</span>
                            @endif
                        </td>
                        <td>{{ $comment->created_at->format('Y/m/d H:i') }}</td>
                        <td>
                            @if(!$comment->is_approved)
                                <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn-action" style="background:#28a745;color:white;" onclick="return confirm('تایید شود؟')">
                                        <i class="fas fa-check"></i>
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" onclick="return confirm('حذف شود؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">
                            <i class="fas fa-inbox fa-2x d-block mb-2" style="color:#ccc;"></i>
                            <span style="color:#6c757d;">هیچ نظری یافت نشد</span>
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