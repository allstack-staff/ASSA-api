<?php

namespace App\Traits\Project;

use App\Exceptions\DomainException;
use App\Models\Project;

trait ProjectFinder
{
    public function findProjectOrFail(int $project_id): Project
    {
        $project = Project::find($project_id);

        if (!$project) {
            throw new DomainException(['Project not found.'], 404);
        }

        return $project;
    }
}
