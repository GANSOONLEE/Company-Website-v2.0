<?php

namespace App\Domains\Order\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DropOrderItemRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute must required.',
        ];
    }

}