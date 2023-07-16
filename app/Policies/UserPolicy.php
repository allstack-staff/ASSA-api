<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function getAll(User $user)
    {
        return $user->isAdmin();
    }
}
