<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        $rules =  [
            'name' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900',
            'quantity' => 'required|integer|min:1',
            'categories' => 'required|array',
        ];

        if ($this->isMethod('post')) {
            $rules['photo'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['photo'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
}
