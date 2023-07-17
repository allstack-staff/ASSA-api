<?php

namespace App\Policies;

use App\Models\User;

class SquadPolicy
{
    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user)
    {
        return $user->isAdmin();
    }

    public function getAll(User $user)
    {
        return $user->isAdmin();
    }

    public function getById(User $user)
    {
        return $user->isAdmin();
    }

    public function deleteById(User $user)
    {
        return $user->isAdmin();
    }
}
