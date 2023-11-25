<?php

namespace App\Containers\DeliveryAudit\Http\Controllers;

use App\Containers\Delivery\Contracts\Repositories\OrderRepositoryInterface;
use App\Containers\Delivery\Facades\Delivery;
use App\Containers\Delivery\Models\Order;
use App\Containers\DeliveryAudit\Adapter\DeliveryAdapter\DeliveryAdapter;
use App\Containers\DeliveryAudit\Contracts\Service\DeliveryAuditRequestServiceInterface;
use App\Containers\DeliveryAudit\Http\Requests\Api\V1\DeliveryAuditRequest;
use App\Ship\Http\Controllers\Controller;

class DeliveryAuditController extends Controller
{
    public function auditRequest(int $orderId, DeliveryAuditRequest $request,  DeliveryAuditRequestServiceInterface $service)
    {
        $serviceResponse = $service->audit($request->getData());

        return apiResponse(true, ['order' => $orderId]);
    }
}
