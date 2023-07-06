<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends AbstractRepository
{
    public function __construct(Project $model)
    {
        $this->model = $model;
    }
}
