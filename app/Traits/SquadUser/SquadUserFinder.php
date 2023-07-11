<?php

namespace App\Traits\Squad;

use App\Exceptions\DomainException;
use App\Models\Squad;
use App\Models\SquadUser;

trait SquadUserFinder
{
    public function findSquadUserOrFailBySquadAndUser(int $user_id, int $squad_id): Squad
    {
        $squadUser = SquadUser::findBySquadAndUser($squad_id, $user_id);
        if (!$squadUser) {
            throw new DomainException(["User doesn't belong to squad."], 403);
        }

        return $squadUser;
    }
}