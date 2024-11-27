<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events'; // Nama tabel di database

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'event_type',
        'reminder',
    ];

    /**
     * Relasi dengan model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
