<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'tracking_code',
        'total_price',
        'status',
        'payment_status',
        'address',
        'phone',
        'notes'
    ];

    protected $casts = [
        'total_price' => 'decimal:0',
    ];

    // ===== روابط =====
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // ===== متدهای کمکی وضعیت =====
    public static function generateTrackingCode()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $code = '';
        for ($i = 0; $i < 10; $i++) {
            $code .= $characters[rand(0, strlen($characters) - 1)];
        }
        while (self::where('tracking_code', $code)->exists()) {
            $code = '';
            for ($i = 0; $i < 10; $i++) {
                $code .= $characters[rand(0, strlen($characters) - 1)];
            }
        }
        return $code;
    }

    public function getFormattedTotalAttribute()
    {
        return number_format($this->total_price) . ' تومان';
    }

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

    // ===== متدهای پرداخت =====
    public function getPaymentStatusPersianAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'در انتظار پرداخت',
            'paid' => 'پرداخت شده',
            'failed' => 'پرداخت ناموفق',
            default => $this->payment_status
        };
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'pending' => 'bg-yellow-500',
            'paid' => 'bg-green-500',
            'failed' => 'bg-red-500',
            default => 'bg-gray-500'
        };
    }

    public function markAsPaid()
    {
        $this->payment_status = 'paid';
        $this->save();
    }

    public function markAsFailed()
    {
        $this->payment_status = 'failed';
        $this->save();
    }
}