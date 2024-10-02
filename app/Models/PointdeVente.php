<?php

namespace App\Models;

use App\Models\TableRestaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PointdeVente extends Model
{
    use HasFactory;
    protected $fillable = ['adresse','restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function tables()
    {
        return $this->hasMany(TableRestaurant::class);
    }
}
