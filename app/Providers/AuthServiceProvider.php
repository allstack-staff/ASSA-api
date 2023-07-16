<?php

namespace App\Providers;

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
    }
}
