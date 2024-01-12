<?php

namespace App\Domains\Category\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateCategoryTitleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required',
            'order' => ['required', Rule::unique('categories_title', 'order')],
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
        ];
    }

}