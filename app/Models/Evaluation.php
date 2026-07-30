<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'type',
        'student_id',
        'mentor_id',
        'score',
        'scores_data',
        'comment',
    ];

    protected $casts = [
        'scores_data' => 'array',
    ];

    // นักศึกษาที่ถูกประเมิน
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // ครูพี่เลี้ยง/อาจารย์ผู้ประเมิน
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }
}
