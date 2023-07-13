<?php

namespace App\Repositories;

use App\Models\Request;

class RequestRepository extends AbstractRepository
{
    public function __construct(Request $model)
    {
        $this->model = $model;
    }

    public function getAllBySquad(int $squad_id)
    {
        return $this->model->where('squad_id', $squad_id)->get();
    }

    public function getAllByProject(int $project_id)
    {
        return $this->model->where('project_id', $project_id)->get();
    }
}
