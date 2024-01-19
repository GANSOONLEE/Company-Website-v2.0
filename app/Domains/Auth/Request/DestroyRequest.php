<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class DestroyRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'password' => 'required',
        ];
    
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
        ];
    }
}