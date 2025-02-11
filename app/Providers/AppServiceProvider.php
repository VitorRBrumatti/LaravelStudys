<?php

namespace App\Providers;

use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\Contracts\UserRepositoryContract;
use Domain\Auth\Contracts\VerifyUserContract;
use Domain\Auth\Repositories\UserRepository;
use Domain\Auth\Services\RegisterUser;
use Domain\Auth\Services\VerifyUserService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\MaintenanceMode;
use Illuminate\Foundation\MaintenanceModeManager as FoundationMaintenanceModeManager;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(RegisterUserContract::class, RegisterUser::class);
        $this->app->bind(VerifyUserContract::class, VerifyUserService::class);
        $this->app->bind(MaintenanceMode::class, FoundationMaintenanceModeManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
