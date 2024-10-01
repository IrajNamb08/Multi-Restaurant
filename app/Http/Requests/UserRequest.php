<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'nom' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'password' => 'required|string|min:8|confirmed',
        ];

        if (auth()->user()->type === 'admin' || auth()->user()->type === 0) {
            $rules['type'] = ['required', Rule::in(['restoAdmin'])];
            $rules['restaurant_id'] = 'required|exists:restaurants,id';
        } elseif (auth()->user()->type === 'restoAdmin' || auth()->user()->type === 1) {
            $rules['type'] = ['required', Rule::in(['manager', 'cuisinier'])];
            $rules['pointdevente_id'] = 'required|exists:pointde_ventes,id';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne peut pas dépasser 255 caractères.',
            'email.required' => 'L\'adresse e-mail est obligatoire.',
            'email.email' => 'Veuillez entrer une adresse e-mail valide.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'password.min' => 'Le mot de passe doit contenir au moins 8 caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'type.required' => 'Le type d\'utilisateur est obligatoire.',
            'type.in' => 'Le type d\'utilisateur sélectionné n\'est pas valide.',
            'restaurant_id.required' => 'Veuillez sélectionner un restaurant.',
            'restaurant_id.exists' => 'Le restaurant sélectionné n\'existe pas.',
            'pointdevente_id.required' => 'Veuillez sélectionner un point de vente.',
            'pointdevente_id.exists' => 'Le point de vente sélectionné n\'existe pas.',
        ];
    }
    public function validateResolved()
    {
        parent::validateResolved();
        
        $this->merge([
            'type' => $this->convertTypeToNumeric($this->type),
        ]);
    }

    protected function convertTypeToNumeric($type)
    {
        $typeMapping = [
            'admin' => 0,
            'restoAdmin' => 1,
            'manager' => 2,
            'cuisinier' => 3
        ];

        return $typeMapping[$type] ?? $type;
    }
}
