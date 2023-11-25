<?php

namespace App\Containers\DeliveryAudit\DataTransfers;

use App\Ship\DataTransfers\DataTransfer;

class AuditReportsData extends DataTransfer
{
    public function __construct(
        public int $vendorId,
    ) {}
}
