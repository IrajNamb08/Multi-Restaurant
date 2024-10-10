<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use App\Models\SousMenu;
use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $restaurant = Restaurant::count();
        $revenueMensuel = $restaurant *100000;
        return view('admin',compact('restaurant','revenueMensuel'));
    }
    public function restoAdmin()
    {
        return view('restoAdmin');
    }
    public function manager()
    {
        return view('manager');
    }
    public function cuisinier()
    {
        $cuisinier = Auth::user();
        $pointdeVente = $cuisinier->pointdeVente;
        $restaurant = $pointdeVente->restaurant;
        
        $commandes = Commande::with(['tableRestaurant', 'sousmenuCommandes.sousMenu'])
            ->whereHas('tableRestaurant', function ($query) use ($pointdeVente) {
                $query->where('pointdevente_id', $pointdeVente->id);
            })
            ->whereIn('etat', ['reçu', 'en_preparation'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('cuisinier',compact('cuisinier','pointdeVente','restaurant','commandes'));
    }
}
