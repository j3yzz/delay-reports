<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy;

use App\Containers\DeliveryAudit\Contracts\Service\AuditStrategy\AuditApproachInterface;
use App\Containers\DeliveryAudit\Entities\Order;

class AuditContext
{
    protected AuditApproachInterface $auditApproach;

    public function execute(Order $order)
    {
        return $this->auditApproach->audit($order);
    }

    /**
     * @param AuditApproachInterface $auditApproach
     */
    public function setAuditApproach(AuditApproachInterface $auditApproach): void
    {
        $this->auditApproach = $auditApproach;
    }

    /**
     * @return AuditApproachInterface
     */
    public function getAuditApproach(): AuditApproachInterface
    {
        return $this->auditApproach;
    }
}
