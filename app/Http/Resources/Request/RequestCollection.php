<?php

namespace App\Http\Resources\Request;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RequestCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return $this->collection;
    }
}