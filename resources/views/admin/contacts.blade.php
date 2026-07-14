@extends('admin.layout')

@section('title', 'پیام‌های کاربران')

@section('content')
    <h2>لیست پیام‌ها</h2>

    <table class="admin-table">
        <thead>
            <tr>
                <th>#</th>
                <th>نام</th>
                <th>ایمیل</th>
                <th>موضوع</th>
                <th>وضعیت</th>
                <th>تاریخ</th>
                <th>عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>{{ $contact->subject }}</td>
                    <td>{{ $contact->is_read ? '✅ خوانده شده' : '🔴 جدید' }}</td>
                    <td>{{ $contact->created_at->format('Y/m/d H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.contacts.show', $contact->id) }}" class="btn-sm btn-edit">👁️ مشاهده</a>
                        <form action="{{ route('admin.contacts.delete', $contact->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-sm btn-delete" onclick="return confirm('آیا مطمئن هستید؟')">🗑️ حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection