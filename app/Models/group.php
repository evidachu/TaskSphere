<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $fillable = [
        'name',
        'description',
        'subject',
        'creator_id',
        'max_members',
    ];

    // Relasi dengan User (Creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    // Relasi many-to-many dengan User (Anggota Grup)
    public function members()
    {
        return $this->belongsToMany(User::class, 'group_members', 'group_id', 'user_id');
    }

    // Relasi dengan Learning Session
    public function learningSessions()
    {
        return $this->hasMany(LearningSession::class);
    }

    // Relasi dengan Dokumen/Materi
    public function documents()
    {
        return $this->hasMany(GroupDocument::class);
    }

    use HasFactory;
}
