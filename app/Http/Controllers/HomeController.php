<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Commande;
use App\Models\SousMenu;
use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TableRestaurant;
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
        $currentUser = auth()->user();
        $pointdeventes = PointdeVente::where('restaurant_id', $currentUser->restaurant_id)->get();
        $managerCount = User::where('restaurant_id', $currentUser->restaurant_id)
                        ->where(function($query) {
                            $query->where('type', 'manager')->orWhere('type', 2);
                        })
                        ->count();

        $cuisinierCount = User::where('restaurant_id', $currentUser->restaurant_id)
                         ->where(function($query) {
                             $query->where('type', 'cuisinier')->orWhere('type', 3);
                         })
                         ->count();
        // Comptage des commandes d'aujourd'hui
        $todayOrdersCount = Commande::whereHas('tableRestaurant.pointdevente', function($query) use ($currentUser) {
            $query->where('restaurant_id', $currentUser->restaurant_id);
        })
        ->whereDate('created_at', Carbon::today())
        ->count();
        $pointdeventes = PointdeVente::where('restaurant_id', $currentUser->restaurant_id)
        ->withSum('commandes as chiffre_affaires_total', 'total')
        ->withSum(['commandes as chiffre_affaires_aujourd_hui' => function($query) {
            $query->whereDate('commandes.created_at', now()->toDateString());
        }], 'total')
        ->get();
        return view('restoAdmin',compact('managerCount','cuisinierCount','pointdeventes','todayOrdersCount'));
    }
    public function manager()
    {
        $currentUser = auth()->user();
        $pointDeVenteId = $currentUser->pointdevente_id;

        $tables = TableRestaurant::where('pointdevente_id', $pointDeVenteId)
            ->withCount([
                'commandes as commandes_en_cours_count' => function ($query) {
                    $query->where('etat', 'reçu');
                },
                'commandes as commandes_en_preparation_count' => function ($query) {
                    $query->where('etat', 'en_preparation');
                },
                'commandes as commandes_pret_a_livrer_count' => function ($query) {
                    $query->where('etat', 'pret_a_livrer');
                }
            ])
            ->get();
    
        // Calculer les totaux pour toutes les tables
        $totalEnCours = $tables->sum('commandes_en_cours_count');
        $totalEnPreparation = $tables->sum('commandes_en_preparation_count');
        $totalPretALivrer = $tables->sum('commandes_pret_a_livrer_count');

        // Récupérer les 5 dernières commandes prêtes à livrer
        $dernieresCommandesPretALivrer = Commande::where('etat', 'pret_a_livrer')
        ->whereIn('table_restaurant_id', $tables->pluck('id'))
        ->with('tableRestaurant')
        ->orderBy('updated_at', 'desc')
        ->take(5)
        ->get(['id', 'numeroCommande', 'table_restaurant_id', 'updated_at']);
    
        return view('manager', compact('tables', 'totalEnCours', 'totalEnPreparation', 'totalPretALivrer','dernieresCommandesPretALivrer'));
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
