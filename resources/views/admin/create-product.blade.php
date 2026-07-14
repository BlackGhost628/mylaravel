@extends('admin.layout')

@section('title', 'افزودن محصول جدید')

@section('content')
    <h2>افزودن محصول جدید</h2>
    
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" style="max-width:600px;">
        @csrf
        
        <div class="form-group">
            <label>نام محصول *</label>
            <input type="text" name="name" required>
        </div>
        
        <div class="form-group">
            <label>توضیحات *</label>
            <textarea name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label>قیمت (تومان) *</label>
            <input type="number" name="price" required>
        </div>
        
        <div class="form-group">
            <label>دسته‌بندی *</label>
            <select name="category" required>
                <option value="pizza">پیتزا</option>
                <option value="kebab">کباب</option>
                <option value="salad">سالاد</option>
                <option value="pasta">پاستا</option>
                <option value="other">سایر</option>
            </select>
        </div>
        
        <div class="form-group">
            <label>تصویر</label>
            <input type="file" name="image" accept="image/*">
        </div>
        
        <div class="form-group">
            <label>
                <input type="checkbox" name="is_featured" value="1">
                محصول ویژه
            </label>
        </div>
        
        <button type="submit" class="btn-primary">ذخیره محصول</button>
        <a href="{{ route('admin.products') }}" style="margin-right:10px;">انصراف</a>
    </form>
@endsection