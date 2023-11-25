<?php

namespace App\Containers\Delivery\Infrastructure\Repositories;

use App\Containers\Delivery\Contracts\Repositories\OrderRepositoryInterface;
use App\Containers\Delivery\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function findById(int $orderId): ?Order
    {
        return Order::query()
            ->where(['id' => $orderId])
            ->first();
    }

    public function firstStatusTripOrderById(int $orderId): ?string
    {
        return Order::query()
            ->select('trips.status')
            ->join('trips', 'trips.order_id', '=', 'orders.id')
            ->where([
                'orders.id' => $orderId,
            ])
            ->pluck('trips.status')
            ->first();
    }
}
