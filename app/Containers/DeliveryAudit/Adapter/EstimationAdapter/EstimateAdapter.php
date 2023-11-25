<?php

namespace App\Containers\DeliveryAudit\Adapter\EstimationAdapter;

use App\Containers\DeliveryAudit\Entities\Order;
use Illuminate\Support\Facades\Http;

class EstimateAdapter
{
    public function getNewDeliverEstimate(Order $order): int
    {
        /// here we can send order_id to 3rd party web-service.
        /// Unfortunately, this platform didn't have the ability to send query parameters.
        $response = Http::retry(3, 120)->get('https://run.mocky.io/v3/f7e66f0e-adf1-4f8e-98b6-c2ed3646de9b');

        if ($response->status() != 200) {
            dd('fuck');
        }

        return $response->json('new_estimation');
    }
}
