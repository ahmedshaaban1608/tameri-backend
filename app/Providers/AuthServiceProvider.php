<?php

namespace App\Providers;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

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
        Gate::define("is-admin", function (User $user) {
            return $user->type === "admin";
        });
        Gate::define("is-tourist", function (User $user) {
            return $user->type === "tourist";
        });
        Gate::define("is-tourguide", function (User $user) {
            return $user->type === "tourguide";
        });
    }
}
