<?php

namespace App\Http\Controllers\Api;

use App\Models\Commande;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TableRestaurant;
use App\Http\Controllers\Controller;

class CommandeAPIController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'table_restaurant_id' => 'required|exists:table_restaurants,id',
            'emplacement' => 'required|boolean',
        ]);

        $table = TableRestaurant::findOrFail($request->table_restaurant_id);
        $pointDeVente = $table->pointdevente;
        $restaurant = $pointDeVente->restaurant;

        $numeroCommande = $this->generateNumeroCommande($restaurant, $pointDeVente, $table);

        $commande = Commande::create([
            'table_restaurant_id' => $request->table_restaurant_id,
            'numeroCommande' => $numeroCommande,
            'emplacement' => $request->emplacement,
        ]);

        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande
        ], 201);
    }
    
    private function generateNumeroCommande($restaurant, $pointDeVente, $table)
    {
        $restaurantInitial = Str::upper(Str::substr($restaurant->nom_resto, 0, 1));
        $pointDeVenteInitial = Str::upper(Str::substr($pointDeVente->adresse, 0, 1));
        $tableId = str_pad($table->id, 3, '0', STR_PAD_LEFT);

        $baseNumero = $restaurantInitial . $pointDeVenteInitial . $tableId;

        $count = Commande::where('numeroCommande', 'like', $baseNumero . '%')->count();
        $sequence = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

        return $baseNumero . $sequence;
    }
    public function show(Commande $id)
    {
        return response()->json($id);
    }
}
