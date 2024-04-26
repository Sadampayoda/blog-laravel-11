<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationProfile extends FormRequest
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
        return [
            'email' => 'required|email|unique:users,email,'.auth()->user()->id,
            'name' => 'required|unique:users,name,'.auth()->user()->id.'|min:4|max:100',
            // 'password' => 'required|min:6|max:100',
            // 'confirmed' => 'required|same:password',
            'image' => 'image|mimes:png,jpg,jpeg|max:2000',
        ];
    }
}
