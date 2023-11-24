<?php

namespace App\Containers\User\Services\Login;

use App\Containers\User\Contracts\Services\LoginServiceInterface;
use App\Containers\User\DataTransfer\LoginData;
use App\Containers\User\Services\Login\Tasks\CheckUserValidityTask;
use App\Containers\User\Services\Login\Tasks\CreateUserAccessTokenTask;

class LoginService implements LoginServiceInterface
{
    public function __construct(
        protected CheckUserValidityTask $checkUserValidityTask,
        protected CreateUserAccessTokenTask $createUserAccessTokenTask
    )
    {
    }

    public function login(LoginData $data)
    {
        $user = $this->checkUserValidityTask->run($data);
        $this->createUserAccessTokenTask->run($user);

        return [
            'user_id' => $user->id,
            'token' => $user->currentAccessToken()->plainTextToken,
        ];
    }
}
