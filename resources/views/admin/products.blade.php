@extends('admin.layout')

@section('title', 'مدیریت محصولات')

@section('content')
<div class="table-container">
    <div class="table-header">
        <h5><i class="fas fa-utensils"></i> لیست محصولات</h5>
        <a href="{{ route('admin.products.create') }}" class="btn-admin-primary">
            <i class="fas fa-plus"></i> افزودن محصول جدید
        </a>
    </div>

    <div class="table-responsive">
        <table class="table-admin">
            <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>نام</th>
                    <th>قیمت</th>
                    <th>دسته</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><img src="{{ $product->image_url }}" class="avatar-sm"></td>
                        <td><strong>{{ $product->name }}</strong></td>
                        <td>{{ number_format($product->price) }} تومان</td>
                        <td>
                            <span class="badge bg-info">
                                @switch($product->category)
                                    @case('pizza') پیتزا @break
                                    @case('kebab') کباب @break
                                    @case('salad') سالاد @break
                                    @case('pasta') پاستا @break
                                    @default {{ $product->category }}
                                @endswitch
                            </span>
                        </td>
                        <td>
                            @if($product->is_featured)
                                <span class="badge bg-warning">⭐ ویژه</span>
                            @else
                                <span class="badge bg-secondary">عادی</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn-action edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-action delete" onclick="return confirm('آیا مطمئن هستید؟')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection