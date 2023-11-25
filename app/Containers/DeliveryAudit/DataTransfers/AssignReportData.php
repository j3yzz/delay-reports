<?php

namespace App\Containers\DeliveryAudit\DataTransfers;

use App\Ship\DataTransfers\DataTransfer;

class AssignReportData extends DataTransfer
{
    public function __construct(
        public int $agentId,
    ) {}
}
