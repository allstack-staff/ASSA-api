<?php

namespace App\Http\Resources\SquadUser;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SquadUserCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}