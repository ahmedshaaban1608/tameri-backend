<?php

namespace App\Providers;

use App\Models\Language;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
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
