<?php

namespace App\Domains\GasOil\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateGasOilRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'model_name' => 'required',
            'model_serial_name' => 'required',
            'gas' => 'required',
            'oil' => 'required',
        ];
    }

}