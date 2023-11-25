<?php

namespace App\Containers\DeliveryAudit\Exceptions;

class OrderHasUnfinishedDelayReportException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["order.has.unfinished.delay_report"]);
    }
}
