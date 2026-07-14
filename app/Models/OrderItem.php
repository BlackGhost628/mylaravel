<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    // رابطه با سفارش
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // رابطه با محصول (با نام جدول صحیح)
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // محاسبه قیمت کل آیتم
    public function getTotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    // فرمت قیمت کل آیتم
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total) . ' تومان';
    }
}