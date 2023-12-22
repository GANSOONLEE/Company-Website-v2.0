<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LoginRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'email' => ['required', 'email', Rule::exists('users', 'email')],
            'password' => 'required',
        ];
    
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            'email.exists' => 'This :attribute <b> ' . $this->attributes()['value'] .'</b> aren\'t exists.',
        ];
    }

    public function attributes(): array
    {
        return [
            'value' => $this->email,
        ];
    }
}