<?php

namespace App\Containers\DeliveryAudit\Contracts\Repositories;

use App\Containers\DeliveryAudit\Models\DelayReport;

interface DelayReportRepositoryInterface
{
    public function create(array $attributes = []): DelayReport;

    public function unfinishedDelayReportByOrderId(int $orderId): ?DelayReport;
}
