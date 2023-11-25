<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\Approaches;

use App\Containers\DeliveryAudit\Entities\Order;
use App\Containers\DeliveryAudit\Contracts\Service\AuditStrategy\AuditApproachInterface;

class DeliveryTrackApproach implements AuditApproachInterface
{

    public function audit(Order $order)
    {
        //// order folan mikone ina
        dd('track');
    }
}
