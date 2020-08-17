<?php

namespace App\Providers;

use App\Constants\UserLevel;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    const MANAGE_PUSKESMAS = "manage-puskesmas";

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(self::MANAGE_PUSKESMAS, function (User $user) {
            return $user->level === UserLevel::SUPER_ADMIN;
        });
    }
}
