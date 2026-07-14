@extends('admin.layout')

@section('title', 'مدیریت کاربران')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-users"></i> لیست کاربران</h5>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>نام</th>
                    <th>ایمیل</th>
                    <th>تلفن</th>
                    <th>نقش</th>
                    <th>تاریخ عضویت</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\User::all() as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge bg-danger">ادمین</span>
                            @else
                                <span class="badge bg-secondary">کاربر</span>
                            @endif
                        </td>
                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection