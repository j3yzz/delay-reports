<?php

namespace App\Containers\DeliveryAudit\DataTransfers;

use App\Ship\DataTransfers\DataTransfer;

class AuditData extends DataTransfer
{
    public function __construct(
        public int $orderId,
    ) {}
}
