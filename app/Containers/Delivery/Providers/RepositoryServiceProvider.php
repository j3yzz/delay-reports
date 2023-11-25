<?php

namespace App\Containers\Delivery\Providers;

use App\Containers\Delivery\Contracts\Repositories\OrderRepositoryInterface;
use App\Containers\Delivery\Infrastructure\Repositories\OrderRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
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
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }
}
