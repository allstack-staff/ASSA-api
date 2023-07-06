<?php

namespace App\Repositories;

use App\Models\Squad;

class SquadRepository extends AbstractRepository
{
    public function __construct(Squad $model)
    {
        $this->model = $model;
    }
}
