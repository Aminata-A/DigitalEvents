<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
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
                $permissionId = $this->route('permission')->id;

                return [
                    'name' => [
                        'required',
                        'string',
                        'unique:permissions,name,' . $permissionId
                    ]
                ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le nom de la permission est obligatoire.',
            'name.string' => 'Le nom de la permission doit être une chaîne de caractères.',
            'name.unique' => 'Le nom de la permission existe déjà.'
        ];
    }
}
