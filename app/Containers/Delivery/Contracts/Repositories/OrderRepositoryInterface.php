<?php

namespace App\Containers\Delivery\Contracts\Repositories;

use App\Containers\Delivery\Models\Order;

interface OrderRepositoryInterface
{
    public function findById(int $orderId): ?Order;

    public function firstStatusTripOrderById(int $orderId): ?string;
}
