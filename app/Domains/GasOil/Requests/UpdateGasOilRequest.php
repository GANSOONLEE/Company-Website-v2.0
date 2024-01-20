<?php

namespace App\Domains\GasOil\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGasOilRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'model_name' => 'nullable',
            'model_serial_name' => 'nullable',
            'gas' => 'nullable',
            'oil' => 'nullable',
        ];
    }

}