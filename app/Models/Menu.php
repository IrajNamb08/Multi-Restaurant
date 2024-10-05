<?php

namespace App\Models;

use App\Models\SousMenu;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id','menu','image_menu'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function sousMenus()
    {
        return $this->hasMany(SousMenu::class);
    }
}
