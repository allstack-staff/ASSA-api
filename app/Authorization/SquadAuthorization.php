<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Models\Squad;
use App\Models\SquadUser;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class SquadAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;
    use SquadUserFinder;

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
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-update-squad', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or coordinator to update a squad."], 403);
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
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-squad-by-id', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or member to get squad by id."], 403);
        }

        return true;
    }

    public static function deleteById(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-delete-squad-by-id', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or coordinator to delete squad by id."], 403);
        }

        return true;
    }
}
