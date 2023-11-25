<?php

namespace App\Containers\Delivery\Facades;

use App\Containers\Delivery\Contracts\Services\Facade\DeliveryManagerInterface;
use App\Ship\Facades\Facade;

/**
 *
 * @method static findOrderById(int $orderId)
 * @method static firstStatusTripOrderByOrderId(int $orderId)
 *
 * @see DeliveryManagerInterface
 */
class Delivery extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return DeliveryManagerInterface::class;
    }
}
