<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Models\User;
use App\Traits\Squad\SquadFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class SquadAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;

    public static function store(int $user_id): bool
    {
        $user = self::findUserOrFail($user_id);

        if (Gate::denies('user-store-squad', $user)) {
            throw new DomainException(["User must be admin to registrate a squad."], 403);
        }

        return true;
    }

    public static function update(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);

        if (Gate::denies('user-update-squad', $user)) {
            throw new DomainException(["User must be admin to update a squad."], 403);
        }

        return true;
    }

    public static function getAll(int $user_id): bool
    {
        $user = self::findUserOrFail($user_id);

        if (Gate::denies('user-get-all-squads', $user)) {
            throw new DomainException(["User must be admin to get all squads."], 403);
        }

        return true;
    }

    public static function getById(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);

        if (Gate::denies('user-get-squad-by-id', $user)) {
            throw new DomainException(["User must be admin to get squad by id."], 403);
        }

        return true;
    }

    public static function deleteById(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);

        if (Gate::denies('user-delete-squad-by-id', $user)) {
            throw new DomainException(["User must be admin to delete squad by id."], 403);
        }

        return true;
    }
}
