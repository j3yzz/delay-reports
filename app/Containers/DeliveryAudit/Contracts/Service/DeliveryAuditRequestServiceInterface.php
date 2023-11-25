<?php

namespace App\Containers\DeliveryAudit\Contracts\Service;

interface DeliveryAuditRequestServiceInterface
{
    public function audit(int $orderId);
}
