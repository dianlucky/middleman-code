<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'username' => 'required|unique:users,username', // username harus unik
            'phone' => 'required|numeric', // phone harus berupa angka
            'password' => 'required|string|min:8', // password minimal 8 karakter
            'name' => 'required|string',
            'birth_date' => 'date',
            'address' => 'string',
        ];
    }

    public function messages()
    {
        return [
            'username.unique' => 'Username sudah digunakan.',
            'phone.numeric' => 'Nomor telepon harus berupa angka.',
            'password.min' => 'Password harus lebih dari 8 karakter.',
        ];
    }
}
