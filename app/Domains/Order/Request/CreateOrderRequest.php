<?php

namespace App\Domains\Order\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'selectedCheckbox' => ['required', 'min:1'],
        ];
    }

    public function message(): array
    {
        return [
            'selectedCheckbox.*.required' => 'The :attribute must required.',
            'selectedCheckbox.*.array' => 'The :attribute must be an array.'
        ];
    }

}