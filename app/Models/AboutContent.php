<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutContent extends Model
{
    protected $fillable = [
        'title',
        'description_1',
        'description_2',
        'image_1',
        'image_2',
        'image_3',
        'image_4',
    ];
}
