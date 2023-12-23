<?php

namespace App\Domains\Auth\Request;

// Laravel Support
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RenewPasswordRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        return [
            'email' => 'required',
            'password' => ['required', 'required_with:confirmed_password', 'same:confirmed_password'],
        ];
    
    }

    public function messages(): array
    {
        return [
            '*.required' => 'The :attribute field is required.',
            'password.same' => 'The password confirmation does not match.',
        ];
    }

}