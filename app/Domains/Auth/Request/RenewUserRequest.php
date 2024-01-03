<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RenewUserRequest extends FormRequest
{

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => ['required', Rule::exists('users', 'id')],
            'name' => 'required',
            'whatsapp_phone' => 'required',
            'contact_phone' => 'required',
            'address' => 'required',
            'profession' => 'required',
            'shop_name' => 'required',
        ];
    }

    public function messages(): array
    {
        return [
            'id.exists' => 'The id aren\'t find',
            '*.required' => 'The :attribute field is required.',
        ];
    }

}