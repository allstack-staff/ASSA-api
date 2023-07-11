<?php

namespace App\Repositories;

use App\Models\SquadUser;
use Illuminate\Support\Facades\DB;

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

    public function getSquadUsersBySquad(int $squad_id)
    {
        return $this->model->where('squad_id', $squad_id)->get();
    }

    public function getUsersBySquad(int $squad_id)
    {
        return $this->model
            ->select(DB::raw('users.*'))
            ->join("users", "users.id", "=", "squad_users.user_id")
            ->where('squad_id', $squad_id)
            ->get();
    }
}
