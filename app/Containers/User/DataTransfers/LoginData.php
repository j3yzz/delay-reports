<?php

namespace App\Containers\User\DataTransfers;

use App\Ship\DataTransfers\DataTransfer;

class LoginData extends DataTransfer
{
    public function __construct(
        public string $phoneNumber,
        public string $password,
    ) {}
}
