<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'contact_phone' => 'required',
            'whatsapp_phone',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password'  => ['required', 'confirmed:confirm_password'],
            'birthday' =>'required',
            'address' =>'required',
            'profession' =>'required',
        ];
    }

    public function message(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            'email.unique' => 'The email are exists.',
            'password.confirmed' => 'The confirmation password does not match.',
        ];
    }

}