<?php

namespace App\Containers\DeliveryAudit\Exceptions;

class AgentHasPendingDelayReportException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["agent.has.pending.delay_report"]);
    }
}
