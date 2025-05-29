<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'level',
        'icon',
        'order',
        'is_active'
    ];

    protected $casts = [
        'level' => 'integer',
        'order' => 'integer',
        'is_active' => 'boolean'
    ];
}