<?php

namespace App\Containers\DeliveryAudit\Http\Requests\Api\V1;

use App\Containers\DeliveryAudit\DataTransfers\AuditData;
use App\Ship\DataTransfers\DataTransfer;
use App\Ship\Http\FormRequest\FormRequest;

class DeliveryAuditRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'order_id' => [
                'required',
                'integer'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'order_id' => $this->route('orderId'),
        ]);
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

        return AuditData::from(['orderId' => $data['order_id']]);
    }
}
