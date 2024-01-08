<?php

namespace App\Domains\Order\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModifyOrderItemRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand' => 'required',
            'quantity' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            '.required' => 'The :attribute must required.',
        ];
    }

}