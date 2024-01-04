<?php

namespace App\Domains\Image\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateImageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['nullable', Rule::unique('images', 'name')],
            'roles' => ['nullable', 'array'],
        ];
    }

    public function message(): array
    {
        return [
            'name.unique' => 'The' . $this->attributes()['name'] . 'have be used.',
        ];
    }

    public function attributes(): array
    {
        return [
            'value' => $this->name,
        ];
    }

}