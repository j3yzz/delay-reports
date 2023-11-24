<?php

namespace App\Containers\User\Contracts\Services;

use App\Containers\User\DataTransfer\LoginData;

interface LoginServiceInterface
{
    public function login(LoginData $data);
}
