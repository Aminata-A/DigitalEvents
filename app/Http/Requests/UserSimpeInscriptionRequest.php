<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSimpeInscriptionRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => ['required', 'string', 'max:20', 'regex:/^(77|78|70|76)[0-9]{7}$/'],
            'password' => 'required|string|min:8',
            'logo' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ];
    }
}
