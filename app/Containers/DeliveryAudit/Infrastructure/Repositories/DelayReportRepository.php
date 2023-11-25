<?php

namespace App\Containers\DeliveryAudit\Infrastructure\Repositories;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Models\DelayReport;

class DelayReportRepository implements DelayReportRepositoryInterface
{

    public function create(array $attributes = []): DelayReport
    {
        return DelayReport::query()->create($attributes);
    }

    public function unfinishedDelayReportByOrderId(int $orderId): ?DelayReport
    {
        return DelayReport::query()
            ->where('order_id', $orderId)
            ->where('status', '!=', DelayReport::STATUS_FINISHED)
            ->orderBy('id', 'DESC')
            ->first();

    }
}
