<?php

namespace App\Policies;

use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class SquadPolicy
{
    private function canAccessSquad(User $user, Squad $squad, SquadUser $squadUser, bool $requireCoordinator = false)
    {
        return $user->isAdmin() ||
            (!$requireCoordinator &&
            $squad->id === $squadUser->squad_id &&
            $user->id === $squadUser->user_id);
    }

    public function store(User $user)
    {
        return $user->isAdmin();
    }

    public function update(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquad($user, $squad, $squadUser, true);
    }

    public function getAll(User $user)
    {
        return $user->isAdmin();
    }

    public function getById(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquad($user, $squad, $squadUser);
    }

    public function deleteById(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquad($user, $squad, $squadUser, true);
    }
}
