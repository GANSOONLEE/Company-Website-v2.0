<?php

namespace App\Domains\Product\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'product-image' => ['required', 'array', 'min:1'],
            'brand-image' => ['required', 'array', 'min:1'],
            'model' => ['required', 'array', 'min:1'],
            'model-serial' => ['required', 'array', 'min:1'],
            'brand' => ['required', 'array', 'min:1'],
            'brand-code' => ['required', 'array', 'min:1'],
            'frozen-code' => ['nullable', 'array', 'min:1'],
            'product_category' => 'required',
            'remark' => 'nullable',
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.array' => 'The :attribute field must be an array.',
            '*.min:1' => 'The :attribute field must have one or above elements.',
        ];
    }

}