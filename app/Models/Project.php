<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;protected $fillable = ['name', 'description']; // Kolom yang bisa diisi

    public function tasks()
    {
        return $this->hasMany(Task::class); // Relasi satu-ke-banyak dengan model Task
    }
}
