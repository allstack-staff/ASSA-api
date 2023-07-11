<?php

namespace App\Traits\User;

use App\Exceptions\DomainException;
use App\Models\User;

trait UserFinder
{
    public function findUserOrFail(int $user_id): User
    {
        $user = User::find($user_id);

        if (!$user) {
            throw new DomainException(['User not found.'], 404);
        }

        return $user;
    }
}