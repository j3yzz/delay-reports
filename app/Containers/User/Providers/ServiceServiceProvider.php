<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Contracts\Services\LoginServiceInterface;
use App\Containers\User\Services\Login\LoginService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(LoginServiceInterface::class, LoginService::class);
    }
}
