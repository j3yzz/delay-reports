<?php

namespace App\Containers\DeliveryAudit\Contracts\Service;

use App\Containers\DeliveryAudit\DataTransfers\AuditReportsData;
use App\Containers\DeliveryAudit\Http\Requests\Api\V1\AuditReportsRequest;

interface VendorDelayReportsServiceInterface
{
    public function reports(AuditReportsData $data);
}
