<?php

namespace App\Domains\Category\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => 'nullable',
            'name' => 'required',
            'order' => 'required',
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
        ];
    }

}