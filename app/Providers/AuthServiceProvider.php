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

    const VIEW_ANY_RENCANA_LIMA_TAHUNAN = "view-any-rencana-lima-tahunan";
    const CREATE_RENCANA_LIMA_TAHUNAN = "create-rencana-lima-tahunan";
    const VIEW_OWN_RENCANA_LIMA_TAHUNAN = "view-own-rencana-lima-tahunan";
    const MANAGE_PUSKESMAS = "manage-puskesmas";
    const MANAGE_UNIT_PUSKESMAS = "manage-unit-puskesmas";
    const MANAGE_UPAYA_KESEHATAN = "manage-upaya-kesehatan";
    const MANAGE_RENCANA_USULAN_KEGIATAN = "manage-rencana-usulan-kegiatan";
    const APPROVE_RENCANA_USULAN_KEGIATAN = "approve-rencana-usulan-kegiatan";
    const APPROVE_RPK_TAHUNAN = "approve-rpk-tahunan";

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

        Gate::define(self::VIEW_ANY_RENCANA_LIMA_TAHUNAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });

        Gate::define(self::CREATE_RENCANA_LIMA_TAHUNAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_PUSKESMAS;
        });

        Gate::define(self::VIEW_OWN_RENCANA_LIMA_TAHUNAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_PUSKESMAS;
        });

        Gate::define(self::MANAGE_RENCANA_USULAN_KEGIATAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_PUSKESMAS;
        });

        Gate::define(self::APPROVE_RENCANA_USULAN_KEGIATAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });

        Gate::define(self::APPROVE_RPK_TAHUNAN, function (User $user) {
            return $user->level === UserLevel::ADMIN_DINAS_KESEHATAN;
        });
    }
}
