<?php

namespace App\Containers\DeliveryAudit\Contracts\Service\AuditStrategy;

use App\Containers\DeliveryAudit\Entities\Order;

interface AuditApproachInterface
{
    public function audit(Order $order);
}
