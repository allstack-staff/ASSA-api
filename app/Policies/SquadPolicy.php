<?php

namespace App\Policies;

use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class SquadPolicy
{
    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $squadUser->role == "Coordinator"
            );
    }

    public function getAll(User $user)
    {
        return $user->isAdmin();
    }

    public function getById(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
            );
    }

    public function deleteById(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $squadUser->role == "Coordinator"
            );
    }
}
