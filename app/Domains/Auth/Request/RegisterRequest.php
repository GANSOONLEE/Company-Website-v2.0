<?php

namespace App\Domains\Auth\Request;

use Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RegisterRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'contact_phone' => ['required', 'max:14'],
            'whatsapp_phone' => ['nullable', 'max:14'],
            'samePhone' => 'nullable',
            'shop_name' => 'required',
            'birthday' => 'required',
            'job' => 'required',
            'address' => 'required',
            'password' => ['required', 'required_with:confirmed_password', 'same:confirmed_password'],
        ];
    
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            'email.unique' => 'This :attribute <b> ' . $this->attributes()['value'] .'</b> are already exists.',
            'password.same' => 'The password confirmation does not match.',
        ];
    }

    public function attributes(): array
    {
        return [
            'value' => $this->email,
        ];
    }
}