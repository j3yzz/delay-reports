<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit;

use App\Containers\Delivery\Models\Order;
use App\Containers\DeliveryAudit\Adapter\DeliveryAdapter\DeliveryAdapter;
use App\Containers\DeliveryAudit\Contracts\Service\DeliveryAuditRequestServiceInterface;
use App\Containers\DeliveryAudit\DataTransfers\AuditData;
use App\Containers\DeliveryAudit\Entities\Order as OrderEntity;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\Approaches\DeliveryEstimateApproach;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\Approaches\DeliveryTrackApproach;
use App\Containers\DeliveryAudit\Services\DeliveryAudit\AuditStrategy\AuditContext;
use App\Ship\Exceptions\ModelNotFoundException;

class DeliveryAuditRequestService implements DeliveryAuditRequestServiceInterface
{
    const TRIP_STATUS_PICKED = 'PICKED';
    const TRIP_STATUS_AT_VENDOR = 'AT_VENDOR';
    const TRIP_STATUS_ASSIGNED = 'ASSIGNED';


    public function __construct(
        protected AuditContext $auditContext,
        protected DeliveryAdapter $deliveryAdapter
    ) {
    }

    public function audit(AuditData $auditData)
    {
        $order = $this->deliveryAdapter->findOrderById($auditData->orderId);
        if (!$order) {
            throw (new ModelNotFoundException())->setModel(Order::class);
        }

        $orderEntity = new OrderEntity(
            $order->id,
            $order->user_id,
            $order->vendor_id,
            $order->ordered_at,
            $order->delivery_time,
            $order->status
        );

        $tripStatus = $this->deliveryAdapter->firstStatusTripOrderByOrderId($orderEntity->getId());

        if (in_array($tripStatus, [self::TRIP_STATUS_ASSIGNED, self::TRIP_STATUS_AT_VENDOR, self::TRIP_STATUS_PICKED])) {
            $this->auditContext->setAuditApproach(new DeliveryEstimateApproach());
        } else {
            $this->auditContext->setAuditApproach(new DeliveryTrackApproach());
        }


        $auditContextExecute = $this->auditContext->execute($orderEntity);
        dd($auditContextExecute);
    }
}
