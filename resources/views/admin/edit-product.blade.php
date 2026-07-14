@extends('admin.layout')

@section('title', 'ویرایش محصول')

@section('content')
    <h2>ویرایش محصول: {{ $product->name }}</h2>
    
    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>نام محصول *</label>
            <input type="text" name="name" value="{{ $product->name }}" required>
        </div>
        
        <div class="form-group">
            <label>توضیحات *</label>
            <textarea name="description" required>{{ $product->description }}</textarea>
        </div>
        
        <div class="form-group">
            <label>قیمت (تومان) *</label>
            <input type="number" name="price" value="{{ $product->price }}" required>
        </div>
        
        <div class="form-group">
            <label>دسته‌بندی *</label>
            <select name="category" required>
                <option value="pizza" @if($product->category == 'pizza') selected @endif>پیتزا</option>
                <option value="kebab" @if($product->category == 'kebab') selected @endif>کباب</option>
                <option value="salad" @if($product->category == 'salad') selected @endif>سالاد</option>
                <option value="pasta" @if($product->category == 'pasta') selected @endif>پاستا</option>
                <option value="other" @if($product->category == 'other') selected @endif>سایر</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>تصویر فعلی</label>
            @if($product->image)
                <img src="{{ $product->image_url }}" style="max-width:150px;display:block;margin-bottom:10px;">
            @endif
            <input type="file" name="image" accept="image/*">
            <small>برای تغییر تصویر، فایل جدید را انتخاب کنید</small>
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1" @if($product->is_featured) checked @endif>
                محصول ویژه
            </label>
        </div>
        
        <button type="submit" class="btn-primary">بروزرسانی محصول</button>
        <a href="{{ route('admin.products') }}" style="margin-right:10px;">انصراف</a>
    </form>
@endsection