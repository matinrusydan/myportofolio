<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'photo',
        'email',
        'phone',
        'address',
        'github_url',
        'whatsapp_url',
        'telegram_url',
    ];
}