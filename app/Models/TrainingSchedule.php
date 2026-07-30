<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrainingSchedule extends Model
{
    protected $fillable = [
        'category',
        'title',
        'description',
        'start_date',
        'end_date',
        'semester',
        'academic_year',
        'location',
        'type',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    // Scope: กิจกรรมที่ active
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope: กิจกรรมที่กำลังจะมาถึง
    public function scopeUpcoming($query)
    {
        return $query->where('start_date', '>=', now()->toDateString())
            ->orderBy('start_date');
    }

    // Scope: กิจกรรมในปีการศึกษาปัจจุบัน
    public function scopeCurrentYear($query, $year = null)
    {
        $year = $year ?? date('Y');
        return $query->where('academic_year', $year);
    }
    
    // Scope: ปฏิทินมหาวิทยาลัย
    public function scopeUniversity($query)
    {
        return $query->where('category', 'university');
    }
    
    // Scope: ปฏิทินคณะ
    public function scopeFaculty($query)
    {
        return $query->where('category', 'faculty');
    }
}
