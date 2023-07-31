<?php

namespace App\Policies;

use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class SquadUserPolicy
{
    private function canAccessSquadUser(User $user, Squad $squad, SquadUser $squadUser, bool $requireCoordinator = false)
    {
        return $user->isAdmin() ||
            (!$requireCoordinator &&
            $squad->id === $squadUser->squad_id &&
            $user->id === $squadUser->user_id);
    }

    public function store(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquadUser($user, $squad, $squadUser, true);
    }

    public function getUsersBySquad(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquadUser($user, $squad, $squadUser);
    }

    public function getBySquadAndUser(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquadUser($user, $squad, $squadUser);
    }

    public function update(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessSquadUser($user, $squad, $squadUser, true);
    }

    public function delete(User $user, Squad $squad, SquadUser $squadUser, SquadUser $squadUserToBeDeleted)
    {
        return $this->canAccessSquadUser($user, $squad, $squadUser, ($squadUser->role === "Coordinator" || $squadUser->id === $squadUserToBeDeleted->id));
    }
}
