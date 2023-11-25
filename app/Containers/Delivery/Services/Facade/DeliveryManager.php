<?php

namespace App\Containers\Delivery\Services\Facade;

use App\Containers\Delivery\Contracts\Repositories\OrderRepositoryInterface;
use App\Containers\Delivery\Contracts\Services\Facade\DeliveryManagerInterface;
use App\Containers\Delivery\Models\Order;

class DeliveryManager implements DeliveryManagerInterface
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepository
    ) {
        $this->orderRepository = app(OrderRepositoryInterface::class);
    }

    public function findOrderById(int $orderId): ?Order
    {
        return $this->orderRepository->findById($orderId);
    }

    public function firstStatusTripOrderByOrderId(int $orderId): ?string
    {
        return $this->orderRepository->firstStatusTripOrderById($orderId);
    }
}
