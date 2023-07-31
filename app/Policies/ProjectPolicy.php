<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class ProjectPolicy
{
    private function canAccessProject(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $user->isAdmin() ||
            ($squad->id === $squadUser->squad_id &&
            $user->id === $squadUser->user_id &&
            $squadUser->role === "Coordinator" &&
            $project->squad_id === $squad->id);
    }

    public function store(User $user, Squad $squad, SquadUser $squadUser)
    {
        return $this->canAccessProject($user, $squad, $squadUser, new Project());
    }

    public function update(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $this->canAccessProject($user, $squad, $squadUser, $project);
    }

    public function deleteById(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $this->canAccessProject($user, $squad, $squadUser, $project);
    }
}
