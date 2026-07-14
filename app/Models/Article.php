<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    const STATUS_DRAFT = 'draft';
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLISHED = 'published';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'author',
        'category',
        'views',
        'status',
        'published_at',
        'user_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'views' => 'integer',
    ];

    protected $attributes = [
        'views' => 0,
        'status' => self::STATUS_DRAFT,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', self::STATUS_PUBLISHED);
    }

    public function scopeDraft($query)
    {
        return $query->where('status', self::STATUS_DRAFT);
    }

    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public static function getStatuses()
    {
        return [
            self::STATUS_DRAFT => '📝 پیش‌نویس',
            self::STATUS_PENDING => '⏳ در انتظار بررسی',
            self::STATUS_PUBLISHED => '✅ منتشر شده',
        ];
    }

    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            self::STATUS_DRAFT => 'bg-warning',
            self::STATUS_PENDING => 'bg-info',
            self::STATUS_PUBLISHED => 'bg-success',
            default => 'bg-secondary',
        };
    }

    public function getStatusPersianAttribute()
    {
        return self::getStatuses()[$this->status] ?? $this->status;
    }

    public function isPublished()
    {
        return $this->status === self::STATUS_PUBLISHED;
    }

    public function isDraft()
    {
        return $this->status === self::STATUS_DRAFT;
    }

    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    // رابطه با نظرات (یک مقاله چندین نظر دارد)
public function comments()
{
    return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
}

// نظرات تایید شده
public function approvedComments()
{
    return $this->hasMany(Comment::class)->where('is_approved', true)->orderBy('created_at', 'desc');
}

// تعداد نظرات تایید شده
public function getApprovedCommentsCountAttribute()
{
    return $this->approvedComments()->count();
}



}