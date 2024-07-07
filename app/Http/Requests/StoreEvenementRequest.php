<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEvenementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Vous pouvez mettre ici la logique d'autorisation si nécessaire
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
{
    return [
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'event_start_date' => 'required|date|after_or_equal:today',
        'event_end_date' => 'required|date|after_or_equal:event_start_date',
        'location' => 'required|string|max:255',
        'registration_deadline' => 'required|date|before_or_equal:event_start_date|after_or_equal:today',
        'places' => 'required|integer|min:1',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
}

public function messages()
{
    return [
        'name.required' => 'Le nom de l\'événement est requis.',
        'name.string' => 'Le nom de l\'événement doit être une chaîne de caractères.',
        'name.max' => 'Le nom de l\'événement ne peut pas dépasser 255 caractères.',
        
        'description.required' => 'La description de l\'événement est requise.',
        'description.string' => 'La description de l\'événement doit être une chaîne de caractères.',
        
        'event_start_date.required' => 'La date de début de l\'événement est requise.',
        'event_start_date.date' => 'La date de début de l\'événement doit être une date valide.',
        'event_start_date.after_or_equal' => 'La date de début de l\'événement doit être égale ou postérieure à aujourd\'hui.',
        
        'event_end_date.required' => 'La date de fin de l\'événement est requise.',
        'event_end_date.date' => 'La date de fin de l\'événement doit être une date valide.',
        'event_end_date.after_or_equal' => 'La date de fin de l\'événement doit être égale ou postérieure à la date de début.',
        
        'location.required' => 'Le lieu de l\'événement est requis.',
        'location.string' => 'Le lieu de l\'événement doit être une chaîne de caractères.',
        'location.max' => 'Le lieu de l\'événement ne peut pas dépasser 255 caractères.',
        
        'registration_deadline.required' => 'La date limite d\'inscription est requise.',
        'registration_deadline.date' => 'La date limite d\'inscription doit être une date valide.',
        'registration_deadline.before_or_equal' => 'La date limite d\'inscription doit être égale ou antérieure à la date de début de l\'événement.',
        'registration_deadline.after_or_equal' => 'La date limite d\'inscription doit être égale ou postérieure à aujourd\'hui.',
        
        'places.required' => 'Le nombre de places est requis.',
        'places.integer' => 'Le nombre de places doit être un nombre entier.',
        'places.min' => 'Le nombre de places doit être au moins 1.',
        
        'image.required' => 'L\'image de l\'événement est requise.',
        'image.image' => 'Le fichier doit être une image.',
        'image.mimes' => 'L\'image doit être au format jpeg, png, jpg ou gif.',
        'image.max' => 'L\'image ne peut pas dépasser 2048 ko.',
    ];
}

}
