<?php

namespace App\Traits\SquadUser;

use App\Exceptions\DomainException;
use App\Models\SquadUser;

trait SquadUserFinder
{
    public function findSquadUserOrFailBySquadAndUser(int $user_id, int $squad_id): SquadUser
    {
        $squadUser = SquadUser::findBySquadAndUser($squad_id, $user_id);
        if (!$squadUser) {
            throw new DomainException(["User doesn't belong to squad."], 403);
        }

        return $squadUser;
    }
}
