<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterLink extends Model
{
    protected $fillable = [
        'category',
        'icon',
        'title',
        'url',
        'sort_order',
    ];
}
