<?php

namespace App\Models;

use App\Models\Menu;
use App\Models\Commande;
use App\Models\SousmenuCommande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SousMenu extends Model
{
    use HasFactory;

    protected $fillable = ['menu_id','nom_sous_menu','prix','description','image_sous_menu','disponibilite'];
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'sousmenu_commandes')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
    public function sousmenuCommandes()
    {
        return $this->hasMany(SousmenuCommande::class, 'sousmenu_id');
    }
}
