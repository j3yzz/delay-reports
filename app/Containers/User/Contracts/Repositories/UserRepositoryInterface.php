<?php

namespace App\Containers\User\Contracts\Repositories;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{
    /**
     * @param string $phoneNumber
     * @return Model|null
     */
    public function findByPhoneNumber(string $phoneNumber): ?Model;
}
