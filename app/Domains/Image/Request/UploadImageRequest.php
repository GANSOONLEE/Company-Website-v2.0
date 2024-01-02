<?php

namespace App\Domains\Image\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UploadImageRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'image' => ['required', 'array', 'min:1'],
        ];
    }

    public function message(): array
    {
        return [
            'image.required' => 'The :attribute field is required.',
            'image.min' => 'Must upload 1 or above image.',
        ];
    }

}