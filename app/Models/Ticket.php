<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory;
    use SoftDeletes;

    // protected $table = 'tableName'; // if is differ

    protected $fillable = [
        'user_id',
        'event_id',
        'rating',
    ];

    // if the table doesn't have timestaps add this line to turnoff
    // public $timestamps = false; 

    // use casts to convert data automatic
    // protected $casts = [
    //     'price' => 'decimal',
    //     'isActive' => 'boolean',
    //     'publishedAt' => 'datetime',
    // ];

    public function event() {
        return $this->belongsTo(Event::class);
    }
}
