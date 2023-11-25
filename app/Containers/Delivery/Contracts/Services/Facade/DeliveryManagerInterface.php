<?php

namespace App\Containers\Delivery\Contracts\Services\Facade;

use App\Containers\Delivery\Models\Order;

interface DeliveryManagerInterface
{
    public function findOrderById(int $orderId): ?Order;

    public function firstStatusTripOrderByOrderId(int $orderId): ?string;
}
