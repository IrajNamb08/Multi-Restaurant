<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\RestaurantRequest;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $restaurants = Restaurant::all();
        return view('restaurant.liste', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurant.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RestaurantRequest $request)
    {
        $restaurant = new Restaurant();
        $restaurant->nom_resto = $request->nom_resto;

        if($request->hasFile('logo')){
            $logo = $request->file('logo');
            $logoName = 'Logo_'.Str::slug($request->nom_resto). '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('logos',$logoName,'public');
            $restaurant->logo = $logoName;
        }
        $restaurant->save();
        return redirect()->route('resto.index')->with('success','Restaurant ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        return view('restaurant.edit',compact('restaurant'));
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
    public function update(RestaurantRequest $request, $id)
    {
        $restaurant = Restaurant::findOrFail($id);
        $restaurant->nom_resto = $request->nom_resto ?? $restaurant->nom_resto;

        if($request->hasFile('logo')){
            if($restaurant->logo){
                Storage::disk('public')->delete('logos/' . $restaurant->logo);
            }
            $logo = $request->file('logo');
            $logoName = 'Logo_' . Str::slug($request->nom_resto ?? $restaurant->nom_resto) . '.' . $logo->getClientOriginalExtension();
            $path = $logo->storeAs('logos', $logoName, 'public');
            $restaurant->logo = $logoName;
        }
        $restaurant->save();
        return redirect()->route('resto.index')->with('success','Mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $restaurant = Restaurant::findOrFail($id);
        if($restaurant->logo){
            Storage::disk('public')->delete('logos/' . $restaurant->logo);
        }
        $restaurant->delete();
        return redirect()->route('resto.index')->with('success','Supprimer avec succès');
    }
}
