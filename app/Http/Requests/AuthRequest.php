<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'username' => 'required',
            'password' => 'required|string|min:8', // password minimal 8 karakter

        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username wajib diisi.',
            'password.min' => 'Password harus lebih dari 8 karakter.',
        ];
    }
}
