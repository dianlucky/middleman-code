<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'username' => [
                'required',
                Rule::unique('users', 'username')->ignore($this->route('id')), // abaikan username milik user yang sedang di-update
            ],
            'phone' => 'required|numeric', // phone harus berupa angka
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
