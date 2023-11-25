<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Contracts\Repositories\DelayReportRepositoryInterface;
use App\Containers\DeliveryAudit\Exceptions\OrderHasUnfinishedDelayReportException;

class CheckUnfinishedQueueDelayReportTask
{
    protected DelayReportRepositoryInterface $delayReportRepository;

    public function __construct(DelayReportRepositoryInterface $delayReportRepository)
    {
        $this->delayReportRepository = $delayReportRepository;
    }

    /**
     * @param int $orderId
     * @return void
     * @throws OrderHasUnfinishedDelayReportException
     */
    public function run(int $orderId): void
    {
        $delayReport = $this->delayReportRepository->unfinishedDelayReportByOrderId($orderId);
        if ($delayReport) {
            throw new OrderHasUnfinishedDelayReportException();
        }
    }
}
