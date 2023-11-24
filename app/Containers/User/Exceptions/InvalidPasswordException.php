<?php

namespace App\Containers\User\Exceptions;

class InvalidPasswordException extends \Exception
{
    public function render($request)
    {
        return apiResponse(false, ["invalid.password"]);
    }
}
