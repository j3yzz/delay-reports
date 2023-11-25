<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\Approaches;

use App\Containers\DeliveryAudit\Adapter\EstimationAdapter\EstimateAdapter;
use App\Containers\DeliveryAudit\Contracts\Service\AuditStrategy\AuditApproachInterface;
use App\Containers\DeliveryAudit\Entities\Order;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks\GenerateDelayReportTask;

class DeliveryEstimateApproach implements AuditApproachInterface
{

    public function audit(Order $order)
    {
        $estimationAdapter = new EstimateAdapter();
        $deliverEstimate = $estimationAdapter->getNewDeliverEstimate($order);

        $generateDelayReport = app(GenerateDelayReportTask::class);
        $generateDelayReport->run($order, DelayReport::APPROACH_RETURN_NEW_ESTIMATION);

        return $deliverEstimate;
    }
}
