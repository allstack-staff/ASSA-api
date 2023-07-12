<?php

namespace App\Repositories;

use App\Models\Project;

class ProjectRepository extends AbstractRepository
{
    public function __construct(Project $model)
    {
        $this->model = $model;
    }

    public function getAllBySquad(int $squad_id)
    {
        return $this->model->where('squad_id', $squad_id)->get();
    }
}
