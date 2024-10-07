<?php

namespace App\Models;

use App\Models\Commande;
use App\Models\SousMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SousmenuCommande extends Model
{
    use HasFactory;
    protected $fillable = ['commande_id', 'sousmenu_id', 'quantite','prix_total'];

    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    public function sousMenu()  
    {
        return $this->belongsTo(SousMenu::class, 'sousmenu_id');
    }
}
