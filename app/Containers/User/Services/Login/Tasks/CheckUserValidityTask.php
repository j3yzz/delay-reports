<?php

namespace App\Containers\User\Services\Login\Tasks;

use App\Containers\User\Contracts\Repositories\UserRepositoryInterface;
use App\Containers\User\DataTransfers\LoginData;
use App\Containers\User\Exceptions\InvalidPasswordException;
use App\Containers\User\Exceptions\PhoneNotVerifiedException;
use App\Containers\User\Models\User;
use App\Ship\Exceptions\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class CheckUserValidityTask
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    )
    {
    }

    public function run(LoginData $data): User
    {
        $user = $this->userRepository->findByPhoneNumber($data->phoneNumber);

        if (!$user) {
            throw (new ModelNotFoundException())->setModel(User::class);
        }

        if (!$user->phone_number_verified_at) {
            throw new PhoneNotVerifiedException();
        }

        if (!Hash::check($data->password, $user->password)) {
            throw new InvalidPasswordException();
        }

        return $user;
    }
}
