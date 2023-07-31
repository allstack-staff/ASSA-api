<?php

namespace App\Providers;

use App\Policies\DemandPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\RequestPolicy;
use App\Policies\SquadPolicy;
use App\Policies\SquadUserPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();

        // USER POLICIES
        Gate::define("user-store-user", [UserPolicy::class, "store"]);
        Gate::define("user-get-all-users", [UserPolicy::class, "getAll"]);

        // SQUAD POLICIES
        Gate::define("user-store-squad", [SquadPolicy::class, "store"]);
        Gate::define("user-update-squad", [SquadPolicy::class, "update"]);
        Gate::define("user-get-all-squads", [SquadPolicy::class, "getAll"]);
        Gate::define("user-get-squad-by-id", [SquadPolicy::class, "getById"]);
        Gate::define("user-delete-squad-by-id", [SquadPolicy::class, "deleteById"]);

        // SQUAD USER POLICIES
        Gate::define("user-add-user-to-squad", [SquadUserPolicy::class, "store"]);
        Gate::define("user-get-users-by-squad", [SquadUserPolicy::class, "getUsersBySquad"]);
        Gate::define("user-get-by-user-and-squad", [SquadUserPolicy::class, "getBySquadAndUser"]);
        Gate::define("user-update-squad-user", [SquadUserPolicy::class, "update"]);
        Gate::define("user-delete-squad-user", [SquadUserPolicy::class, "delete"]);

        // PROJECT POLICIES
        Gate::define("user-add-project-to-squad", [ProjectPolicy::class, "store"]);
        Gate::define("user-update-project", [ProjectPolicy::class, "update"]);
        Gate::define("user-delete-project", [ProjectPolicy::class, "deleteById"]);

        // DEMANDS POLICIES
        Gate::define("user-add-demand-to-project", [DemandPolicy::class, "store"]);
        Gate::define("user-update-demand", [DemandPolicy::class, "update"]);
        Gate::define("user-get-all-demands-by-project", [DemandPolicy::class, "getAllByProject"]);
        Gate::define("user-get-demands-by-id", [DemandPolicy::class, "getById"]);
        Gate::define("delete-demand-by-id", [DemandPolicy::class, "delete"]);

        // REQUEST POLICIES
        Gate::define("user-add-demand-request", [RequestPolicy::class, "store"]);
        Gate::define("user-get-all-demand-requests-by-project", [RequestPolicy::class, "getAllByProject"]);
        Gate::define("user-get-demand-request", [RequestPolicy::class, "getById"]);
    }
}
