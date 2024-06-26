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
            'event_start_date' => 'required|date',
            'event_end_date' => 'required|date|after_or_equal:event_start_date',
            'location' => 'required|string|max:255',
            'registration_deadline' => 'required|date|before_or_equal:event_start_date',
            'places' => 'required|integer|min:1',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
