<?php

namespace App\Models;

// Use requirements.

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    // Use requirements
    use HasFactory, SoftDeletes;

    // Attributes could be fillable
    protected $fillable = [
        'name',
        'description',
        'date',
        'category',
        'location',
        'capacity',
        'available_tickets',
        'image_path',
    ];

    // Attributes can't be fillable
    protected $hidden = [
        // 'id',
    ];

    // Attributes should casts
    protected function casts(): array
    {
        return [
            'data' => 'datetime',
        ];
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
