<?php

namespace App\Domains\Model\Request;

use App\Models\CarModel as Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateModelRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => ['required', 'max:100', Rule::unique('models', 'name')],
        ];
    }

    public function message(): array
    {
        return [
            'name.*.exists' => __('The car model are exists.')
        ];
    }

}