<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'image',
        'is_active',
        'is_pinned',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'is_pinned' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    // ผู้ประกาศ
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope: ข่าวที่ active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: ข่าวที่เผยแพร่แล้ว
    public function scopePublished($query)
    {
        return $query->active()
            ->where(function ($q) {
                $q->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }

    // Scope: ปักหมุดก่อน
    public function scopePinnedFirst($query)
    {
        return $query->orderByDesc('is_pinned')->latest();
    }
}
