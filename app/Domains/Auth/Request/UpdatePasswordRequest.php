<?php

namespace App\Domains\Auth\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class UpdatePasswordRequest extends FormRequest
{

    protected $stopOnFirstFailure = true;

    use AuthorizesRequests, ValidatesRequests;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required',
            'current-password' => ['required'],
            'new-password' => ['required', 'required_with:confirm-password', 'same:confirm-password'],
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