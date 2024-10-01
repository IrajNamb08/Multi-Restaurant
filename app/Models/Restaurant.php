<?php

namespace App\Models;

use App\Models\User;
use App\Models\PointdeVente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Restaurant extends Model
{
    use HasFactory;
    protected $fillable = ['nom_resto','logo'];
    
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function pointdeventes()
    {
        return $this->hasMany(PointdeVente::class);
    }
}
