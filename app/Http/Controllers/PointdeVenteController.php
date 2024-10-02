<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PointdeVenteRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class PointdeVenteController extends Controller
{
    use HandlesAuthorization;

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (Auth::user()->type !== 'restoAdmin') {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        });
    }
    public function index()
    {
        $pointdeventes = PointdeVente::where('restaurant_id', auth()->user()->restaurant_id)->get();
        $restaurant_id = auth()->user()->restaurant_id;
        $restaurant = Restaurant::find($restaurant_id);
        return view('point_de_vente.liste', compact('pointdeventes','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('point_de_vente.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PointdeVenteRequest $request)
    {
        $data = $request->validated();
        $data['restaurant_id'] = auth()->user()->restaurant_id;
        PointdeVente::create($data);
        return redirect()->route('ptvente.index')->with('success','Point de vente ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pointdevente = PointdeVente::findOrFail($id);
        return view('point_de_vente.edit',compact('pointdevente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PointdeVenteRequest $request,$id)
    {
        $pointdevente = PointdeVente::findOrFail($id);
        $pointdevente->adresse = $request->adresse;
        $pointdevente->restaurant_id = auth()->user()->restaurant_id;
        $pointdevente->save();
        return redirect()->route('ptvente.index')->with('success','Point de vente modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pointdevente = PointdeVente::findOrFail($id);
        if ($pointdevente->restaurant_id !== Auth::user()->restaurant_id) {
            return redirect()->route('ptvente.index')->with('error', 'Vous n\'êtes pas autorisé à supprimer ce point de vente.');
        }

        try {
            $pointdevente->delete();
            return redirect()->route('ptvente.index')->with('success', 'Point de vente supprimé avec succès');
        } catch (Exception $e) {
            return redirect()->route('ptvente.index')->with('error', 'Une erreur est survenue lors de la suppression du point de vente.');
        }
    }
}
