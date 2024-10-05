<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SousMenuResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'menu_id' => $this->menu_id,
            'nom_sous_menu' => $this->nom_sous_menu,
            'prix' => $this->prix,
            'description' => $this->description,
            'image_sous_menu' => $this->image_sous_menu,
            'disponibilite' => $this->disponibilite,
        ];
    }
}
