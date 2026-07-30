<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CalendarSetting extends Model
{
    protected $fillable = [
        'category',
        'pdf_file',
        'image_file',
    ];
}
