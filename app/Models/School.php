<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'school_name',
        'affiliation',
        'province',
        'mentor_name',
    ];

    // ความสัมพันธ์: โรงเรียนมีสมาชิกหลายคน
    public function memberProfiles()
    {
        return $this->hasMany(MemberProfile::class);
    }

    // นักศึกษาที่ฝึกสอนในโรงเรียนนี้ (ผ่าน MemberProfile)
    public function students()
    {
        return $this->hasManyThrough(
            User::class,
            MemberProfile::class,
            'school_id',  // FK ใน member_profiles
            'id',         // FK ใน users
            'id',         // PK ใน schools
            'user_id'     // FK ใน member_profiles ชี้ไป users
        );
    }
}
