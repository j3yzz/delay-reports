<?php

namespace App\Containers\User\Http\Controllers\Api\V1\Auth;

use App\Containers\User\Contracts\Services\LoginServiceInterface;
use App\Containers\User\Http\Requests\Api\V1\LoginRequest;
use App\Ship\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(LoginRequest $request, LoginServiceInterface $service)
    {
        $login = $service->login($request->getData());

        return apiResponse(true, $login);
    }
}
