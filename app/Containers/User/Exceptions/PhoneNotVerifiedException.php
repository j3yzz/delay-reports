<?php

namespace App\Containers\User\Exceptions;

class PhoneNotVerifiedException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["phone_number.not_verified"]);
    }
}
