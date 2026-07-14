<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // داخل کلاس Order، در بخش $fillable
protected $fillable = [
    'user_id',
    'order_number',
    'tracking_code', // ← اضافه کن
    'total_price',
    'status',
    'tracking_code', // دقت کن! اینجا دوبار نوشته شده، یکی رو پاک کن. باید فقط یکبار باشه.
    'address',
    'phone',
    'notes'
];

// و یه متد برای تولید کد رهگیری
public static function generateTrackingCode()
{
    do {
        $code = 'TRK-' . strtoupper(uniqid()) . '-' . rand(1000, 9999);
    } while (self::where('tracking_code', $code)->exists());

    return $code;
}

    protected $casts = [
        'total_price' => 'decimal:0'
    ];

    // رابطه با کاربر
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // رابطه با آیتم‌های سفارش
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // متد برای فرمت قیمت
    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_price) . ' تومان';
    }

    // متد برای وضعیت فارسی
    public function getStatusPersianAttribute()
    {
        return match($this->status) {
            'pending' => 'در انتظار',
            'processing' => 'در حال آماده‌سازی',
            'delivered' => 'تحویل شده',
            'cancelled' => 'لغو شده',
            default => $this->status
        };
    }

    // متد برای بج وضعیت
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'bg-yellow-500',
            'processing' => 'bg-blue-500',
            'delivered' => 'bg-green-500',
            'cancelled' => 'bg-red-500',
            default => 'bg-gray-500'
        };
    }

    




}