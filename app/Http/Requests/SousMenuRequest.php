<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SousMenuRequest extends FormRequest
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
        $rules = [
            'menu_id' => 'required',
            'nom_sous_menu' => 'required|string|max:255',
            'prix' => 'required|numeric|between:0,999999.99',
            'description' => 'required|string',
        ];

        // Si c'est une création (POST) ou si un fichier est présent dans la requête
        if ($this->isMethod('post') || $this->hasFile('image_sous_menu')) {
            $rules['image_sous_menu'] = 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3000';
        }

        return $rules;
    }

    public function messages()
    {
        return[
            'nom_sous_menu.required' => 'Le champ du nom sous menu est obligatoire',
            'nom_sous_menu.string' => 'Le champ doit être en chaîne de caractère',
            'nom_sous_menu.max' => 'Le champ ne doit pas dépasser 255 caractères',
            'prix.required' => 'Le champ prix est obligatoire',
            'prix.decimal' => 'Le prix doit être en chiffres',
            'description.required' => 'Le champ description est obligatoire',
            'image_sous_menu.required' => 'Image obligatoire vous devez le fournir',
            'image_sous_menu.image' => 'Fichier doit être image',
            'image_sous_menu.mimes' => 'Fichier image doit avoir comme extension jpeg,png,jpg,gif,svg',
            'image_sous_menu.max' => 'Fichier trop volumineux ne doit pas dépasser 2mb'
        ];
    }
}
