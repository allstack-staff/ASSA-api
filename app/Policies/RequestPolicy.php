<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class RequestPolicy
{
    private function canAccessRequest(User $user, Squad $squad, SquadUser $squadUser, Project $project = null)
    {
        return $user->isAdmin() ||
            ($squad->id === $squadUser->squad_id &&
            $user->id === $squadUser->user_id &&
            (!$project || $project->squad_id === $squad->id));
    }

    public function store(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessRequest($user, $squad, $squadUser);
    }

    public function getAllByProject(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $this->canAccessRequest($user, $squad, $squadUser, $project);
    }

    public function getById(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $this->canAccessRequest($user, $squad, $squadUser, $project);
    }
}
