<?php

namespace App\Containers\DeliveryAudit\Exceptions;

class DeliveryTimeNotPastException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["delivery.time.is.not.past"]);
    }
}
