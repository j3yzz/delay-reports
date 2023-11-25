<?php

namespace App\Containers\DeliveryAudit\Contracts\Service;

use App\Containers\DeliveryAudit\DataTransfers\AssignReportData;

interface AssignDelayReportServiceInterface
{
    public function execute(AssignReportData $data);
}
