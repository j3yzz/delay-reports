<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Entities\Order;
use App\Containers\DeliveryAudit\Models\DelayReport;

class GenerateDelayReportTask
{
    protected DelayReportRepositoryInterface $delayReportRepository;

    public function __construct(
        DelayReportRepositoryInterface $delayReportRepository
    ) {
        $this->delayReportRepository = $delayReportRepository;
    }

    public function run(Order $order, string $approachType)
    {
        return $this->delayReportRepository->unfinishedDelayReportByOrderId($order->getId())
            ?: $this->delayReportRepository->create([
                'order_id' => $order->getId(),
                'approach_type' => $approachType,
                'status' => $approachType == DelayReport::APPROACH_RETURN_NEW_ESTIMATION ? DelayReport::STATUS_FINISHED : DelayReport::STATUS_PENDING,
            ]);
    }
}
