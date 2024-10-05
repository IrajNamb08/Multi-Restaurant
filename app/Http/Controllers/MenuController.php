<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\MenuRequest;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::where('restaurant_id',auth()->user()->restaurant_id)->get();
        $restaurant_id = auth()->user()->restaurant_id;
        $restaurant = Restaurant::find($restaurant_id);
        return view('menu.liste', compact('menus','restaurant'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.ajout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MenuRequest $request)
    {
        $menu = new Menu();
        $menu->menu = $request->menu;
        $menu->restaurant_id = auth()->user()->restaurant_id;
        if($request->hasFile('image_menu')){
            $image_menu = $request->file('image_menu');
            $imageMenuName = 'Menu_'.Str::slug($request->menu). '.' . $image_menu->getClientOriginalExtension();
            $path = $image_menu->storeAs('menus',$imageMenuName,'public');
            $menu->image_menu = $imageMenuName;
        }
        $menu->save();
        return redirect()->route('menu.index')->with('success','Menu ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        return view('menu.edit',compact('menu'));
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
    public function update(MenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->menu =  $request->menu ?? $menu->menu;
        $menu->restaurant_id = auth()->user()->restaurant_id;
        if($request->hasFile('image_menu')){
            if($menu->image_menu){
                Storage::disk('public')->delete('menus/' . $menu->image_menu);
            }
            $image_menu = $request->file('image_menu');
            $imageMenuName = 'Menu_'.Str::slug($request->menu ?? $menu->menu). '.' . $image_menu->getClientOriginalExtension();
            $path = $image_menu->storeAs('menus',$imageMenuName,'public');
            $menu->image_menu = $imageMenuName;
        }
        $menu->save();
        return redirect()->route('menu.index')->with('success','Menu mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::findOrFail($id);
        if($menu->image_menu){
            Storage::disk('public')->delete('menus/' . $menu->image_menu);
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success','Menu supprimé avec succès');
    }
}
