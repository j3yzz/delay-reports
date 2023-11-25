<?php

namespace App\Containers\DeliveryAudit\Adapter\DeliveryAdapter;

use App\Containers\Delivery\Facades\Delivery;

class DeliveryAdapter
{

    public function findOrderById(int $orderId)
    {
        return Delivery::findOrderById($orderId);
    }

    public function firstStatusTripOrderByOrderId(int $orderId)
    {
        return Delivery::firstStatusTripOrderByOrderId($orderId);
    }
}
