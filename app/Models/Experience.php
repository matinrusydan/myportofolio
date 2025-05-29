<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'company',
        'description',
        'start_date',
        'end_date',
        'technologies',
        'order',
        'is_active'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'order' => 'integer',
        'is_active' => 'boolean'
    ];

    // Accessor untuk format tanggal yang lebih readable
    public function getFormattedStartDateAttribute()
    {
        return $this->start_date ? $this->start_date->format('M Y') : null;
    }

    public function getFormattedEndDateAttribute()
    {
        return $this->end_date ? $this->end_date->format('M Y') : 'Present';
    }
}