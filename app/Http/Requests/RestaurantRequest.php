<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            'nom_resto' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'nom_resto.required' => 'Le nom du restaurant est obligatoire.',
            'nom_resto.string' => 'Le nom du restaurant doit être une chaîne de caractères.',
            'nom_resto.max' => 'Le nom du restaurant ne peut pas dépasser 255 caractères.',
            'logo.image' => 'Le logo doit être une image.',
            'logo.mimes' => 'Le logo doit être au format jpeg, png, jpg, gif ou svg.',
            'logo.max' => 'La taille du logo ne peut pas dépasser 2048 kilobytes.',
        ];
    }
}
