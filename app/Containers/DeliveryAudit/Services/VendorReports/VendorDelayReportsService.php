<?php

namespace App\Containers\DeliveryAudit\Services\VendorReports;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Contracts\Service\VendorDelayReportsServiceInterface;
use App\Containers\DeliveryAudit\DataTransfers\AuditReportsData;

class VendorDelayReportsService implements VendorDelayReportsServiceInterface
{
    protected DelayReportRepositoryInterface $delayReportRepository;

    public function __construct(DelayReportRepositoryInterface $delayReportRepository)
    {
        $this->delayReportRepository = $delayReportRepository;
    }

    public function reports(AuditReportsData $data)
    {
        return $this->delayReportRepository->getVendorDelayReportsLastWeek($data->vendorId);
    }
}
