<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Traits\Project\ProjectFinder;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class ProjectAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;
    use SquadUserFinder;
    use ProjectFinder;

    public static function store(int $user_id, int $squad_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-add-project-to-squad', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or coordinator to registrate a project."], 403);
        }

        return true;
    }

    public static function update(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-update-project', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or coordinator to update a project."], 403);
        }

        return true;
    }

    public static function deleteById(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-delete-project', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or coordinator to delete a project by id."], 403);
        }

        return true;
    }
}
