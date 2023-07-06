<?php

namespace App\Http\Resources\Squad;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SquadCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}