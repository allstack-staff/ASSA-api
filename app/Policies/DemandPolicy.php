<?php

namespace App\Policies;

use App\Models\Demand;
use App\Models\Project;
use App\Models\Squad;
use App\Models\SquadUser;
use App\Models\User;

class DemandPolicy
{
    public function store(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $project->squad_id == $squad->id
            );
    }

    public function update(User $user, Squad $squad, SquadUser $squadUser, Project $project, Demand $demand)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $project->squad_id == $squad->id
                &&
                $demand->project_id == $project->id
            );
    }

    public function getAllByProject(User $user, Squad $squad, SquadUser $squadUser, Project $project)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $project->squad_id == $squad->id
            );
    }

    public function getById(User $user, Squad $squad, SquadUser $squadUser, Project $project, Demand $demand)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $project->squad_id == $squad->id
                &&
                $demand->project_id = $project->id
            );
    }

    public function delete(User $user, Squad $squad, SquadUser $squadUser, Project $project, Demand $demand)
    {
        return $user->isAdmin() ||
            ($squad->id == $squadUser->squad_id
                &&
                $user->id == $squadUser->user_id
                &&
                $project->squad_id == $squad->id
                &&
                $demand->project_id = $project->id
                &&
                $squadUser->role == "Coordinator"
            );
    }
}
