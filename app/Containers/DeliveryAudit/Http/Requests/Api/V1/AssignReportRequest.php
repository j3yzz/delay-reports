<?php

namespace App\Containers\DeliveryAudit\Http\Requests\Api\V1;

use App\Containers\DeliveryAudit\DataTransfers\AssignReportData;
use App\Ship\DataTransfers\DataTransfer;
use App\Ship\Http\FormRequest\FormRequest;

class AssignReportRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'agent_id' => [
                'required',
                'integer',
            ]
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'agent_id' => $this->header('X_AGENT_ID'),
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

        return AssignReportData::from(['agentId' => $data['agent_id']]);
    }
}
