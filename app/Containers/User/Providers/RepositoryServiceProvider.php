<?php

namespace App\Containers\User\Providers;

use App\Containers\User\Contracts\Repositories\UserRepositoryInterface;
use App\Containers\User\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }
}
