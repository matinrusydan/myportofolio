<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'url',
        'location',
        'is_featured',
        'order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];
}