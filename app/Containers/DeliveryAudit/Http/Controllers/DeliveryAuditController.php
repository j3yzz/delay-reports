<?php

namespace App\Containers\DeliveryAudit\Http\Controllers;

use App\Containers\Delivery\Contracts\Repositories\OrderRepositoryInterface;
use App\Containers\Delivery\Facades\Delivery;
use App\Containers\Delivery\Models\Order;
use App\Containers\DeliveryAudit\Adapter\DeliveryAdapter\DeliveryAdapter;
use App\Containers\DeliveryAudit\Contracts\Service\AssignDelayReportServiceInterface;
use App\Containers\DeliveryAudit\Contracts\Service\DeliveryAuditRequestServiceInterface;
use App\Containers\DeliveryAudit\Http\Requests\Api\V1\AssignReportRequest;
use App\Containers\DeliveryAudit\Http\Requests\Api\V1\DeliveryAuditRequest;
use App\Containers\DeliveryAudit\Models\DelayReport;
use App\Ship\Http\Controllers\Controller;

class DeliveryAuditController extends Controller
{
    public function auditRequest(int $orderId, DeliveryAuditRequest $request,  DeliveryAuditRequestServiceInterface $service)
    {
        $serviceResponse = $service->audit($request->getData());
        $auditApproach = $service->getAuditApproach();

        if ($auditApproach == DelayReport::APPROACH_ADD_TO_QUEUE) {
            $response = [
                'approach_type' => $auditApproach
            ];
        } else {
            $response = [
                'new_estimation_time' => $serviceResponse,
                'approach_type' => $auditApproach
            ];
        }

        return apiResponse(true, $response);
    }

    public function assignReport(AssignReportRequest $request, AssignDelayReportServiceInterface $service)
    {
        // IMPROVE: better to use Resource
        $serviceResponse = $service->execute($request->getData());

        return apiResponse(true, $serviceResponse);
    }
}
