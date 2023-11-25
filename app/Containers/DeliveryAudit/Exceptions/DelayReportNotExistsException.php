<?php

namespace App\Containers\DeliveryAudit\Exceptions;

class DelayReportNotExistsException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["delay_report.not.exists.in.queue"]);
    }
}
