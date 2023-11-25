<?php

namespace App\Containers\User\Http\Requests\Api\V1;

use App\Containers\User\DataTransfers\LoginData;
use App\Ship\DataTransfers\DataTransfer;
use App\Ship\Http\FormRequest\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
//                'exists:users,phone_number',
            ],
            'password' => [
                'required',
            ]
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function getData(): DataTransfer
    {
        $data = $this->validator->validated();

        return LoginData::from([
            'phoneNumber' => $data['phone_number'],
            'password' => $data['password'],
        ]);
    }
}
