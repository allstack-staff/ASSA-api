<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Models\User;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class UserAuthorization extends Authorization
{
    use UserFinder;

    public static function store(int $user_id): bool
    {
        $user = self::findUserOrFail($user_id);

        if (Gate::denies('user-store-user', $user)) {
            throw new DomainException(["User must be admin to registrate another user."], 403);
        }

        return true;
    }

    public static function getAll(int $user_id): bool
    {
        $user = self::findUserOrFail($user_id);

        if (Gate::denies('user-get-all-users', $user)) {
            throw new DomainException(["User must be admin to registrate another user."], 403);
        }

        return true;
    }
}