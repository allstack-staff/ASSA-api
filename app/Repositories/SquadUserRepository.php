<?php

namespace App\Repositories;

use App\Models\SquadUser;

class SquadUserRepository extends AbstractRepository
{
    public function __construct(SquadUser $model)
    {
        $this->model = $model;
    }

    public function getBySquadAndUser(int $squad_id, int $user_id)
    {
        return $this->model->where('squad_id', $squad_id)->where('user_id', $user_id)->first();
    }
}
