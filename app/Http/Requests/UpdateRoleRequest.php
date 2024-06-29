<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
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
        // L'ID de la permission à exclure de l'unicité
        $roleId = $this->route('role')->id;

        return [
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $roleId
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom du rôle est obligatoire.',
            'name.string' => 'Le nom du rôle doit être une chaîne de caractères.',
            'name.unique' => 'Le nom du rôle existe déjà.'
        ];
    }
}
