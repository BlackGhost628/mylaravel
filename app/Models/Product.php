<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // نام جدول را مشخص می‌کنیم
    protected $table = 'food_products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category',
        'is_featured',
        'rating',
        'likes'
    ];

    // متد برای فرمت قیمت
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price) . ' تومان';
    }

    // متد برای گرفتن آدرس تصویر
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('image/' . $this->image) : asset('image/default.jpg');
    }
}