<?php

namespace App\Policies;

use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class SquadUserPolicy
{
    public function store(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $squadUser->role == "Coordinator"
            );
    }

    public function getUsersBySquad(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
            );
    }

    public function getBySquadAndUser(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
            );
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

    public function delete(User $user, Squad $squad, SquadUser $squadUser, SquadUser $squadUserToBeDeleted)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                ($squadUser->role == "Coordinator" || $squadUser->id == $squadUserToBeDeleted->id)
            );
    }
}
