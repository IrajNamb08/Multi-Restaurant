<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SousMenu;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\SousMenuRequest;
use Illuminate\Support\Facades\Storage;

class SousMenuController extends Controller
{
    
    public function index(Request $request)
    {
        $restaurant = auth()->user()->restaurant;
        $menus = Menu::where('restaurant_id', $restaurant->id)->pluck('menu', 'id');
        $query = SousMenu::whereHas('menu', function ($q) use ($restaurant) {
            $q->where('restaurant_id', $restaurant->id);
        });
        if ($request->has('menu_id') && $request->menu_id != '') {
            $query->where('menu_id', $request->menu_id);
        }
        $sousMenus = $query->paginate(5);
        return view('sousmenus.liste', compact('sousMenus', 'menus', 'restaurant'));
    }

    public function create()
    {
        $restaurant = auth()->user()->restaurant;
        $menus = Menu::where('restaurant_id', $restaurant->id)->pluck('menu', 'id');
        return view('sousmenus.ajout',compact('menus'));
    }

    public function store(SousMenuRequest $request)
    {
        $sousmenu = new SousMenu();
        $sousmenu->menu_id = $request->menu_id;
        $sousmenu->nom_sous_menu = $request->nom_sous_menu;
        $sousmenu->prix = $request->prix;
        $sousmenu->description = $request->description;
        if($request->hasFile('image_sous_menu')){
            $image_sous_menu = $request->file('image_sous_menu');
            $imageSousMenuName = 'Sous_Menu'.Str::slug($request->nom_sous_menu). '.' . $image_sous_menu->getClientOriginalExtension();
            $path = $image_sous_menu->storeAs('sousmenus',$imageSousMenuName,'public');
            $sousmenu->image_sous_menu = $imageSousMenuName;
        }
        $sousmenu->save();
        return redirect()->route('sousmenu.index')->with('success','Sous-Menu ajouté avec succès');
    }

    public function show($id)
    {
        $restaurant = auth()->user()->restaurant;
        $menus = Menu::where('restaurant_id', $restaurant->id)->pluck('menu', 'id');
        $sousmenu = SousMenu::findOrFail($id);
        return view('sousmenus.edit',compact('menus','sousmenu'));
    }

    public function update(SousMenuRequest $request, $id)
    {
        $sousmenu = SousMenu::findOrFail($id);
        $sousmenu->menu_id = $request->menu_id;
        $sousmenu->nom_sous_menu = $request->nom_sous_menu;
        $sousmenu->prix = $request->prix;
        $sousmenu->description = $request->description;
        $sousmenu->disponibilite = $request->has('disponibilite') ? 1 : 0;
        if($request->hasFile('image_sous_menu')){
            if($sousmenu->image_sous_menu){
                Storage::disk('public')->delete('sousmenus/' . $sousmenu->image_sous_menu);
            }
            $image_sous_menu = $request->file('image_sous_menu');
            $imageSousMenuName = 'Sous_Menu'.Str::slug($request->nom_sous_menu). '.' . $image_sous_menu->getClientOriginalExtension();
            $path = $image_sous_menu->storeAs('sousmenus',$imageSousMenuName,'public');
            $sousmenu->image_sous_menu = $imageSousMenuName;
        }
        $sousmenu->save();
        return redirect()->route('sousmenu.index')->with('success','Sous-Menu mis à jour avec succès');
    }

    public function delete($id)
    {
        $sousmenu = SousMenu::findOrFail($id);
        if($sousmenu->image_sous_menu){
            Storage::disk('public')->delete('sousmenus/' . $sousmenu->image_sous_menu);
        }
        $sousmenu->delete();
        return redirect()->route('sousmenu.index')->with('success','Sous-Menu delete avec succès');
    }
}
