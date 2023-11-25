<?php

namespace App\Containers\DeliveryAudit\Providers;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Infrastructure\Repositories\DelayReportRepository;
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
        $this->app->bind(DelayReportRepositoryInterface::class, DelayReportRepository::class);
    }
}
