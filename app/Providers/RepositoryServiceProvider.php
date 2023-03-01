<?php

namespace App\Providers;

use App\Contracts\{
    AdminContract,
    ProfileContract,
    RolePermissionContract,
};
use App\Repositories\{
    RolePermissionRepository,
    AdminRepository,
    ProfileRepository
};
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        AdminContract::class => AdminRepository::class,
        RolePermissionContract::class => RolePermissionRepository::class,
        ProfileContract::class => ProfileRepository::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach ($this->repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
