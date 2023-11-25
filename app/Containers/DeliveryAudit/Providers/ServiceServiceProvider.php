<?php

namespace App\Containers\DeliveryAudit\Providers;

use App\Containers\DeliveryAudit\Contracts\Service\DeliveryAuditRequestServiceInterface;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\DeliveryAuditRequestService;
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
        $this->app->bind(DeliveryAuditRequestServiceInterface::class, DeliveryAuditRequestService::class);
    }
}
