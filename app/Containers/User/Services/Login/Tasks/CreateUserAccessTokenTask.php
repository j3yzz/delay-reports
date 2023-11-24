<?php

namespace App\Containers\User\Services\Login\Tasks;

use App\Containers\User\Models\User;

class CreateUserAccessTokenTask
{
    public function run(User $user)
    {
        $personalAccessToken = $user->createToken('customer-auth');
        $user->withAccessToken($personalAccessToken);
    }
}
