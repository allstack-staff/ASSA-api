<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class SquadUserAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;
    use SquadUserFinder;

    public static function store(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-add-user-to-squad', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or coordinator to add a user to a squad."], 403);
        }

        return true;
    }

    public static function getUsersBySquad(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-users-by-squad', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or belong to squad."], 403);
        }

        return true;
    }

    public static function getBySquadAndUser(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-by-user-and-squad', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or belong to squad."], 403);
        }

        return true;
    }

    public static function update(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-update-squad-user', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or coordinator to update."], 403);
        }

        return true;
    }

    public static function delete(int $user_id, int $squad_id, int $user_id_to_be_deleted): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);
        $squad_user_to_be_deleted = self::findSquadUserOrFailBySquadAndUser($user_id_to_be_deleted, $squad_id);

        if (Gate::denies('user-delete-squad-user', [$squad, $squad_user, $squad_user_to_be_deleted])) {
            throw new DomainException(["User must be admin, coordinator or belong to squad to delete."], 403);
        }

        return true;
    }
}
