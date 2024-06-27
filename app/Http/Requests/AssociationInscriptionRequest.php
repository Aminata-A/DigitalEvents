<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssociationInscriptionRequest extends FormRequest
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
            'adress' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'activity_area' => 'required|string|max:255',
            'phone' => 'required|string|max:15',
            'ninea' => 'required|integer',
            'password' => 'required|string|min:8',
            'creation_date' => 'required|date',
            'description' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de l\'association est obligatoire.',
            'email.required' => 'L\'adresse email est obligatoire.',
            'email.email' => 'L\'adresse email doit être une adresse email valide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit comporter au moins 8 caractères.',
            'password.confirmed' => 'Les mots de passe ne correspondent pas.',
            'phone.required' => 'Le téléphone est obligatoire.',
            'logo.required' => 'Le logo est obligatoire.',
            'logo.image' => 'Le fichier doit être une image.',
            'logo.max' => 'Le logo ne doit pas dépasser 2MB.',
            'description.required' => 'La description est obligatoire.',
            'adress.required' => 'L\'adresse est obligatoire.',
            'activity_area.required' => 'Le domaine d\'activité est obligatoire.',
            'ninea.required' => 'Le NINEA est obligatoire.',
            'creation_date.required' => 'La date de création est obligatoire.',
            'creation_date.date' => 'La date de création doit être une date valide.',
            'account_status.required' => 'Le statut du compte est obligatoire.',
            'validation_status.required' => 'Le statut de validation est obligatoire.',
        ];
    }
}
