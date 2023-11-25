<?php

namespace App\Containers\DeliveryAudit\Http\Requests\Api\V1;

use App\Containers\DeliveryAudit\DataTransfers\AssignReportData;
use App\Containers\DeliveryAudit\DataTransfers\AuditReportsData;
use App\Ship\DataTransfers\DataTransfer;
use App\Ship\Http\FormRequest\FormRequest;

class AuditReportsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'vendor_id' => [
                'required',
                'integer',
                // it's better to remove following rule and check vendor existing into Business logic
                'exists:vendors,id'
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'vendor_id' => $this->route('vendorId'),
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

        return AuditReportsData::from(['vendorId' => $data['vendor_id']]);
    }
}
