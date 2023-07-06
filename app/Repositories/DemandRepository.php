<?php

namespace App\Repositories;

use App\Models\Demand;

class DemandRepository extends AbstractRepository
{
    public function __construct(Demand $model)
    {
        $this->model = $model;
    }
}
