<?php

namespace App\Authorization;

use App\Exceptions\DomainException;
use App\Traits\Demand\DemandFinder;
use App\Traits\Project\ProjectFinder;
use App\Traits\Squad\SquadFinder;
use App\Traits\SquadUser\SquadUserFinder;
use App\Traits\User\UserFinder;
use Illuminate\Support\Facades\Gate;

class DemandAuthorization extends Authorization
{
    use UserFinder;
    use SquadFinder;
    use SquadUserFinder;
    use ProjectFinder;
    use DemandFinder;

    public static function store(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-add-demand-to-project', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or belong to squad to registrate a demand."], 403);
        }

        return true;
    }

    public static function update(int $user_id, int $squad_id, int $project_id, int $demand_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $demand = self::findDemandOrFail($demand_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-update-demand', [$squad, $squad_user, $project, $demand])) {
            throw new DomainException(["User must be admin or belong to squad to update a demand."], 403);
        }

        return true;
    }

    public static function getAllByProject(int $user_id, int $squad_id, int $project_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-all-demands-by-project', [$squad, $squad_user, $project])) {
            throw new DomainException(["User must be admin or belong to squad to get all demands by project."], 403);
        }

        return true;
    }

    public static function getById(int $user_id, int $squad_id, int $project_id, int $demand_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $demand = self::findDemandOrFail($demand_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('user-get-demands-by-id', [$squad, $squad_user, $project, $demand])) {
            throw new DomainException(["User must be admin or belong to squad to get demand by id."], 403);
        }

        return true;
    }

    public static function delete(int $user_id, int $squad_id, int $project_id, int $demand_id): bool
    {
        $user = self::findUserOrFail($user_id);
        $squad = self::findSquadOrFail($squad_id);
        $project = self::findProjectOrFail($project_id);
        $demand = self::findDemandOrFail($demand_id);
        $squad_user = self::findSquadUserOrFailBySquadAndUser($user_id, $squad_id);

        if (Gate::denies('delete-demand-by-id', [$squad, $squad_user, $project, $demand])) {
            throw new DomainException(["User must be admin or coordinator to delete a demand by id."], 403);
        }

        return true;
    }
}
