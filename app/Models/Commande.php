<?php

namespace App\Models;

use App\Models\TableRestaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commande extends Model
{
    use HasFactory;
    protected $fillable = ['table_restaurant_id','numeroCommande','emplacement'];

    public function tableRestaurant()
    {
        return $this->belongsTo(TableRestaurant::class);
    }
}
