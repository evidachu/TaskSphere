<?php

namespace App\Policies; // Pastikan namespace sesuai dengan lokasi folder

use App\Models\User;
use App\Models\Group;

class GroupPolicy
{
    // Hanya creator yang bisa update grup
    public function update(User $user, Group $group)
    {
        return $user->id === $group->creator_id;
    }

    // Hanya creator yang bisa delete grup
    public function delete(User $user, Group $group)
    {
        return $user->id === $group->creator_id;
    }
}
