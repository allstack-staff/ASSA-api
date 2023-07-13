<?php

namespace App\Traits\Request;

use App\Exceptions\DomainException;
use App\Models\Request;

trait RequestFinder
{
    public function findRequestOrFail(int $request_id): Request
    {
        $request = Request::find($request_id);

        if (!$request) {
            throw new DomainException(['Request not found.'], 404);
        }

        return $request;
    }
}
