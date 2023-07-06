<?php

namespace App\Http\Resources\Demand;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DemandCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}