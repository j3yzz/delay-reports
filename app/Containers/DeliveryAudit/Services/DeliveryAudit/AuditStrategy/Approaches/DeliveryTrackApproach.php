<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\Approaches;

use App\Containers\DeliveryAudit\Entities\Order;
use App\Containers\DeliveryAudit\Contracts\Service\AuditStrategy\AuditApproachInterface;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\CheckUnfinishedQueueDelayReportTask;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\GenerateDelayReportTask;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\PushDelayReportToQueueTask;
use Illuminate\Support\Facades\Redis;

class DeliveryTrackApproach implements AuditApproachInterface
{

    public function audit(Order $order)
    {
        app(CheckUnfinishedQueueDelayReportTask::class)->run($order->getId());

        $generateDelayReport = app(GenerateDelayReportTask::class);
        $delayReport = $generateDelayReport->run($order, DelayReport::APPROACH_ADD_TO_QUEUE);

        $pushDelayReportToQueue = app(PushDelayReportToQueueTask::class);
        $pushDelayReportToQueue->run($delayReport);

        return true;
    }
}
