<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'article_id',
        'content',
        'is_approved',
    ];

    protected $casts = [
        'is_approved' => 'boolean',
    ];

    // رابطه با کاربر
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // رابطه با مقاله
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    // متد بررسی تایید شده
    public function isApproved()
    {
        return $this->is_approved === true;
    }

    // متد بررسی تایید نشده
    public function isPending()
    {
        return $this->is_approved === false;
    }

    // متد برای فرمت تاریخ
    public function getCreatedAtPersianAttribute()
    {
        return $this->created_at->format('Y/m/d H:i');
    }

    // متد برای دریافت نام کاربر
    public function getUserNameAttribute()
    {
        return $this->user->name ?? 'کاربر ناشناس';
    }

    // متد برای دریافت ایمیل کاربر
    public function getUserEmailAttribute()
    {
        return $this->user->email ?? 'ایمیل نامشخص';
    }
}