<?php

namespace App\Http\Controllers\Api;

use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\MenuResource;
use App\Http\Resources\SousMenuResource;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\PointdeVenteResource;

class RestaurantAPIController extends Controller
{
    public function show($restaurantId, $pointDeVenteId)
    {
        $restaurant = Restaurant::findOrFail($restaurantId);
        $pointDeVente = PointdeVente::findOrFail($pointDeVenteId);

        return response()->json([
            'restaurant' => new RestaurantResource($restaurant),
            'pointdevente' => new PointdeVenteResource($pointDeVente),
            'menu' => MenuResource::collection($restaurant->menus),
            'sousmenu' => SousMenuResource::collection($restaurant->menus->flatMap->sousMenus),
        ]);
    }
}
