<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules(): array
    {
        $userId = $this->route('user');
        return [
            'name' => 'required|string',
            'username' => 'required|max:100|unique:users,username,' . $userId,
            'email' => 'required|email',
            'address' => 'required|string',
            'password' => 'required|string',
        ];

    }
}
