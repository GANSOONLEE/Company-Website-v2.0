<?php

namespace App\Domains\Cart\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCartRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required',
            'quantity' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
        ];
    }

}