<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function updateEtat(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);
        $commande->etat = $request->etat;
        $commande->save();
        return response()->json(['success' => true]);
    }
}
