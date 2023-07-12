<?php

namespace App\Repositories;

use App\Models\Demand;

class DemandRepository extends AbstractRepository
{
    public function __construct(Demand $model)
    {
        $this->model = $model;
    }

    public function getAllByProject(int $project_id)
    {
        return $this->model->where('project_id', $project_id)->get();
    }
}
