<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'menu' => 'required|string|max:255',
            'image_menu' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return[
            'menu.required' => 'Le champ menu est obligatoire',
            'menu.string' => 'Le champ menu doit être une chaine de caractère',
            'menu.max' => 'Le champ menu ne doit pas dépasser 255 caractères',
            'image_menu.required' => 'Image représentant le menu est obligatoire',
            'image_menu.image' => 'Le champ doit être une image',
            'image_menu.mimes' => 'Le champ doit être une image de type jpeg,png',
            'image_menu.max' => 'Le champ doit être une image de taille inférieure à 2048 kilobytes'
        ];
    }
}
