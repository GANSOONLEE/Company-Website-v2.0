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
            'name' => ['required', Rule::unique('images', 'name')],
        ];
    }

    public function message(): array
    {
        return [
            'name.required' => 'The :attribute field is required.',
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