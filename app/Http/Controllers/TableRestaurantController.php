<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\PointdeVente;
use Illuminate\Http\Request;
use App\Models\TableRestaurant;
use App\Http\Requests\TableRestaurantRequest;

class TableRestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pointdevente = auth()->user()->pointdevente_id;
        $tables = TableRestaurant::where('pointdevente_id',$pointdevente)->get();
        $pointdevente = PointdeVente::findOrFail($pointdevente);
        $restaurant_id = $pointdevente->restaurant_id;
        $restaurant = Restaurant::findOrFail($restaurant_id);

        return view('table_restaurant.liste',compact('tables','pointdevente','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('table_restaurant.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TableRestaurantRequest $request)
    {
        $data = $request->validated();
        $data['pointdevente_id'] = auth()->user()->pointdevente_id;
        $table = TableRestaurant::create($data);
        $table->generateQrCode();
        return redirect()->route('table.index')->with('success','Table ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
