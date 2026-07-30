<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'date',
        'status',
        'check_in_time',
        'check_out_time',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
        ];
    }

    // นักศึกษา
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Scope: วันนี้
    public function scopeToday($query)
    {
        return $query->where('date', now()->toDateString());
    }

    // ตรวจสอบว่า check-in แล้วหรือยัง
    public function hasCheckedIn(): bool
    {
        return !is_null($this->check_in_time);
    }

    // ตรวจสอบว่า check-out แล้วหรือยัง
    public function hasCheckedOut(): bool
    {
        return !is_null($this->check_out_time);
    }
}
