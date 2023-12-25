<?php

namespace App\Domains\Model\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateModelRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:100'],
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => __('The car model must be string, give null.')
        ];
    }

}