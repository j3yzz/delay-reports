<?php

namespace App\Ship\Http\FormRequest;

use App\Ship\DataTransfers\DataTransfer;
use Illuminate\Foundation\Http\FormRequest as BaseFormRequest;

abstract class FormRequest extends BaseFormRequest
{
    abstract public function getData(): DataTransfer;
}
