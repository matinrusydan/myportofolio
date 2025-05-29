<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'issuer',
        'description',
        'date',
        'icon',
        'url',
        'order',
        'is_active'
    ];

    protected $casts = [
        'date' => 'date',
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    // Accessor untuk format tanggal
    public function getFormattedDateAttribute()
    {
        return $this->date ? $this->date->format('Y') : null;
    }
}