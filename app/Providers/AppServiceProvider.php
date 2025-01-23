<?php

namespace App\Providers;

use Domain\Auth\Contracts\RegisterUserContract;
use Domain\Auth\Services\RegisterUser;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(RegisterUserContract::class, RegisterUser::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
