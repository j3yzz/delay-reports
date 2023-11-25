<?php

namespace App\Containers\Delivery\Providers;

use App\Containers\Delivery\Contracts\Services\Facade\DeliveryManagerInterface;
use App\Containers\Delivery\Services\Facade\DeliveryManager;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
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
        $this->app->bind(DeliveryManagerInterface::class, DeliveryManager::class);
    }
}
