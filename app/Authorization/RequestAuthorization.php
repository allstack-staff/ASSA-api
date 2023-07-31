<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Traits\Project\ProjectFinder;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class RequestAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;
    use SquadUserFinder;
    use ProjectFinder;

    public static function store(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-add-demand-request', [$squad, $squad_user])) {
            throw new DomainException(["User must be admin or belong to a squad to registrate a request."], 403);
        }

        return true;
    }

    public static function getAllByProject(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-all-demand-requests-by-project', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or belong to a squad to get all requests by project."], 403);
        }

        return true;
    }

    public static function getById(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-demand-request', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or belong to a squad to get request."], 403);
        }

        return true;
    }
}
