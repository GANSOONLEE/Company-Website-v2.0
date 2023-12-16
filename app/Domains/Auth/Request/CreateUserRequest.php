<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class CreateUserRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => ['required', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'role' => 'nullable',
            'address' => 'nullable',
            'contact_phone' => 'nullable',
            'password' => ['nullable', 'confirmed:confirm_password'],
            'birthday' => 'nullable',
            'profession' => 'nullable',
        ];
    
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            '*.unique' => 'The :attribute already exists.',
            'password.confirmed' => 'The confirmation password does not match.',
        ];
    }

}