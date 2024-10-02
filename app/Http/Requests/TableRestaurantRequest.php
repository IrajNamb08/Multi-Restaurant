<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableRestaurantRequest extends FormRequest
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
            'numero_table' => 'required|string|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'numero_table.required' => 'Le numéro de table est obligatoire.',
            'numero_table.max' => 'Le numéro de table ne peut pas dépasser 255 caractères.',
            'pointde_vente_id.required' => 'Le point de vente est obligatoire.',
            'pointde_vente_id.exists' => 'Le point de vente sélectionné n\'existe pas.',
        ];
    }
}
