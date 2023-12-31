<?php

namespace App\Containers\DeliveryAudit\Providers;

use App\Containers\DeliveryAudit\Contracts\Service\AssignDelayReportServiceInterface;
use App\Containers\DeliveryAudit\Contracts\Service\DeliveryAuditRequestServiceInterface;
use App\Containers\DeliveryAudit\Contracts\Service\VendorDelayReportsServiceInterface;
use App\Containers\DeliveryAudit\Services\AssignDelayReport\AssignDelayReportService;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\DeliveryAuditRequestService;
use App\Containers\DeliveryAudit\Services\VendorReports\VendorDelayReportsService;
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
        $this->app->bind(AssignDelayReportServiceInterface::class, AssignDelayReportService::class);
        $this->app->bind(VendorDelayReportsServiceInterface::class, VendorDelayReportsService::class);
    }
}
