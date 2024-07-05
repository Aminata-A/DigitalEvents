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
            'phone' => ['required', 'string', 'max:20', 'regex:/^(77|78|70|76)[0-9]{7}$/', 'unique:users,phone'],
            'password' => 'required|string|min:8',
            'logo' => 'required|image|mimes:jpeg,png,gif|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ nom est requis.',
            'name.string' => 'Le champ nom doit être une chaîne de caractères.',
            'name.max' => 'Le champ nom ne doit pas dépasser 255 caractères.',

            'email.required' => 'Le champ email est requis.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',

            'phone.required' => 'Le champ téléphone est requis.',
            'phone.string' => 'Le champ téléphone doit être une chaîne de caractères.',
            'phone.max' => 'Le champ téléphone ne doit pas dépasser 20 caractères.',
            'phone.regex' => 'Le champ téléphone doit être un numéro valide commençant par 77, 78, 70 ou 76.',
            'phone.unique' => 'Ce numéro téléphone est déjà utilisée.',

            'password.required' => 'Le champ mot de passe est requis.',
            'password.string' => 'Le champ mot de passe doit être une chaîne de caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',

            'logo.required' => 'Le champ logo est requis.',
            'logo.image' => 'Le champ logo doit être une image.',
            'logo.mimes' => 'Le logo doit être un fichier de type: jpeg, png, gif.',
            'logo.max' => 'Le logo ne doit pas dépasser 2 Mo.',
        ];
    }
}
