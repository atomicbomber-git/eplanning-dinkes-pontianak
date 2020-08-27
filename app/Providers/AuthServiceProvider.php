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

    const MANAGE_ANY_RENCANA_LIMA_TAHUNAN = "manage-any-rencana-lima-tahunan";
    const MANAGE_PUSKESMAS = "manage-puskesmas";
    const MANAGE_UNIT_PUSKESMAS = "manage-unit-puskesmas";
    const MANAGE_UPAYA_KESEHATAN = "manage-upaya-kesehatan";

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define(self::MANAGE_PUSKESMAS, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });

        Gate::define(self::MANAGE_UNIT_PUSKESMAS, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });

        Gate::define(self::MANAGE_UPAYA_KESEHATAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });

        Gate::define(self::MANAGE_ANY_RENCANA_LIMA_TAHUNAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });
    }
}
