<?php

namespace App\Traits\Demand;

use App\Exceptions\DomainException;
use App\Models\Demand;

trait DemandFinder
{
    public function findDemandOrFail(int $demand_id): Demand
    {
        $demand = Demand::find($demand_id);

        if (!$demand) {
            throw new DomainException(['Demand not found.'], 404);
        }

        return $demand;
    }
}
