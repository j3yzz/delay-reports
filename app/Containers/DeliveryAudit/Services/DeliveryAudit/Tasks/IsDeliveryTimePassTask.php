<?php

namespace App\Containers\DeliveryAudit\Services\DeliveryAudit\Tasks;

use App\Containers\DeliveryAudit\Exceptions\DeliveryTimeNotPastException;
use Carbon\Carbon;

class IsDeliveryTimePassTask
{
    /**
     * @param $orderedAt
     * @param $deliveryTime
     * @return void
     * @throws DeliveryTimeNotPastException
     */
    public function run($orderedAt, $deliveryTime): void
    {
        $orderedAt = Carbon::parse($orderedAt);
        $deliveryDatetime = $orderedAt->addMinutes($deliveryTime);

        if (!$deliveryDatetime->isPast()) {
            throw new DeliveryTimeNotPastException();
        }
    }
}
