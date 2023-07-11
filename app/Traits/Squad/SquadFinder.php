<?php

namespace App\Traits\Squad;

use App\Exceptions\DomainException;
use App\Models\Squad;

trait SquadFinder
{
    public function findSquadOrFail(int $squad_id): Squad
    {
        $squad = Squad::find($squad_id);

        if (!$squad) {
            throw new DomainException(['Squad not found.'], 404);
        }

        return $squad;
    }
}