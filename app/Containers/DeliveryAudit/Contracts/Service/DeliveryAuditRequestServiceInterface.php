<?php

namespace App\Containers\DeliveryAudit\Contracts\Service;

use App\Containers\DeliveryAudit\DataTransfers\AuditData;

interface DeliveryAuditRequestServiceInterface
{
    public function audit(AuditData $auditData);

    public function getAuditApproach(): string;
}
