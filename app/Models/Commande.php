<?php

namespace App\Models;

use App\Models\SousMenu;
use App\Models\TableRestaurant;
use App\Models\SousmenuCommande;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['table_restaurant_id','numeroCommande','emplacement','etat','note','total'];

    public function tableRestaurant()
    {
        return $this->belongsTo(TableRestaurant::class);
    }

    public function sousmenuCommandes()
    {
        return $this->hasMany(SousmenuCommande::class);
    }

    public function sousMenus()
    {
        return $this->belongsToMany(SousMenu::class, 'sousmenu_commandes')
                    ->withPivot('quantite')
                    ->withTimestamps();
    }
}
