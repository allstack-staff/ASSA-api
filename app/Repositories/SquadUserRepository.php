<?php

namespace App\Repositories;

use App\Models\SquadUser;

class SquadUserRepository extends AbstractRepository
{
    public function __construct(SquadUser $model)
    {
        $this->model = $model;
    }
}
