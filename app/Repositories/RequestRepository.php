<?php

namespace App\Repositories;

use App\Models\Request;

class RequestRepository extends AbstractRepository
{
    public function __construct(Request $model)
    {
        $this->model = $model;
    }
}
