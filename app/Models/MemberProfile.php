<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MemberProfile extends Model
{
    // กำหนดฟิลด์ที่อนุญาตให้บันทึกข้อมูลได้
    protected $fillable = [
        'user_id', 
        'name_th', 
        'name_en',
        'position',
        'academic_rank',
        'school_name', 
        'school_affiliation',
        'province', 
        'phone',
        'subject_taught',
        'grade_level',
        'experience_years',
        'school_id'
    ];

    // ความสัมพันธ์: โปรไฟล์นี้เป็นของ User หนึ่งคน
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ความสัมพันธ์: โปรไฟล์นี้สังกัดโรงเรียนหนึ่งแห่ง
    public function school()
    {
        return $this->belongsTo(School::class);
    }
}