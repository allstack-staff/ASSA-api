<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use Illuminate\Support\Facades\Gate;

class Authorization
{
    public function authorize(string $ability, $arguments = []): bool
    {
        if (Gate::denies($ability, $arguments)) {
            throw new DomainException(["Permission denied"], 403);
        }

        return true;
    }
}