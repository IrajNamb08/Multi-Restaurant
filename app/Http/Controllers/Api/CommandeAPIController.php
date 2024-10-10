<?php

namespace App\Http\Controllers\Api;

use App\Models\Commande;
use App\Models\SousMenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TableRestaurant;
use App\Models\SousmenuCommande;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CommandeAPIController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'table_restaurant_id' => 'required|exists:table_restaurants,id',
            'emplacement' => 'required|boolean',
            'etat' => 'sometimes|in:reçu,en_preparation,pret,annule',
            'note' => 'sometimes|nullable|string',
            'items' => 'required|array',
            'items.*.id' => 'required|exists:sous_menus,id',
            'items.*.quantite' => 'required|integer|min:1',
        ]);

        $table = TableRestaurant::findOrFail($request->table_restaurant_id);
        $pointDeVente = $table->pointdevente;
        $restaurant = $pointDeVente->restaurant;

        $numeroCommande = $this->generateNumeroCommande($restaurant, $pointDeVente, $table);

        $commande = Commande::create([
            'table_restaurant_id' => $request->table_restaurant_id,
            'numeroCommande' => $numeroCommande,
            'emplacement' => $request->emplacement,
            'etat' => $request->etat ?? 'reçu',
            'note' => $request->note,
        ]);
        $totalCommande = 0;

        foreach ($request->items as $item) {
            $sousMenu = SousMenu::findOrFail($item['id']);
            $prixTotal = $sousMenu->prix * $item['quantite'];
            $totalCommande += $prixTotal;

            SousmenuCommande::create([
                'commande_id' => $commande->id,
                'sousmenu_id' => $item['id'],
                'quantite' => $item['quantite'],
                'prix_total' => $prixTotal,
            ]);
        }
        $commande->update(['total' => $totalCommande]);
        $commande->load('sousmenuCommandes.sousMenu');
        return response()->json([
            'message' => 'Commande créée avec succès',
            'commande' => $commande,
        ], 201);
    }
    public function showMultipleStates(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:commandes,id'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $commandes = Commande::whereIn('id', $request->ids)
                             ->select('id', 'etat')
                             ->get();

        $result = $commandes->map(function ($commande) {
            return [
                'id' => $commande->id,
                'etat' => $commande->etat
            ];
        });

        return response()->json($result);
    }
    public function update(Request $request, Commande $id)
    {
        $request->validate([
            'emplacement' => 'sometimes|boolean',
            'etat' => 'sometimes|in:reçu,en_preparation,pret,annule',
            'note' => 'sometimes|nullable|string',
        ]);

        $commande->update($request->only(['emplacement', 'etat', 'note']));

        return response()->json([
            'message' => 'Commande mise à jour avec succès',
            'commande' => $commande
        ]);
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
}
