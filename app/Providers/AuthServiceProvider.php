<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Http\Enums\AccessLevels;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define("is_admin", function (User $user) {
            return $user->access_level === AccessLevels::ADMIN->access();
        });

        Gate::define("is_team_lead", function (User $user) {
            return $user->access_level === AccessLevels::TEAM_LEAD->access();
        });
    }
}
