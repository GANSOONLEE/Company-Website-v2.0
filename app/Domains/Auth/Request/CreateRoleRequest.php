<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRoleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'weight' => ['required', 'numeric', 'max:100'],
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            'weight.numeric' => 'Weight must be a number.',
            'weight.max' => 'The number can\'t more them 100.',
        ];
    }

}