<?php

namespace App\Containers\User\Infrastructure\Repositories;

use App\Containers\User\Contracts\Repositories\UserRepositoryInterface;
use App\Containers\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    public function findByPhoneNumber(string $phoneNumber): ?Model
    {
        return User::query()
            ->where([
                'phone_number' => $phoneNumber
            ])->first();
    }
}
