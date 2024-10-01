<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentUser = auth()->user();
    
        if ($currentUser->type === 'admin') {
            $users = User::where('type', 'restoAdmin')->with('restaurant')->get();
        } elseif ($currentUser->type === 'restoAdmin') {
            $users = User::where('restaurant_id', $currentUser->restaurant_id)
                        ->whereIn('type', ['manager', 'cuisinier'])
                        ->with('pointdevente')
                        ->get();
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('utilisateur.liste', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUser = auth()->user();
        $allowedTypes = [];
        $restaurants = null;
        $pointsDeVente = null;

        if ($currentUser->type === 'admin') {
            $allowedTypes = ['restoAdmin'];
            $restaurants = Restaurant::all();
        } elseif ($currentUser->type === 'restoAdmin') {
            $allowedTypes = ['manager', 'cuisinier'];
            $pointsDeVente = PointdeVente::where('restaurant_id', $currentUser->restaurant_id)->get();
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('utilisateur.ajout', compact('allowedTypes', 'restaurants', 'pointsDeVente'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $userData = $request->validated();
        $userData['password'] = Hash::make($userData['password']);
        
        if (auth()->user()->type === 'restoAdmin') {
            $userData['restaurant_id'] = auth()->user()->restaurant_id;
        }

        User::create($userData);

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $currentUser = auth()->user();
        $allowedTypes = [];
        $restaurants = null;
        $pointsDeVente = null;

        if ($currentUser->type === 'admin') {
            $allowedTypes = ['restoAdmin'];
            $restaurants = Restaurant::all();
        } elseif ($currentUser->type === 'restoAdmin') {
            $allowedTypes = ['manager', 'cuisinier'];
            $pointsDeVente = PointdeVente::where('restaurant_id', $currentUser->restaurant_id)->get();
        } else {
            return redirect()->back()->with('error', 'Vous n\'avez pas les permissions nécessaires.');
        }

        return view('utilisateur.edit', compact('user', 'allowedTypes', 'restaurants', 'pointsDeVente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $userData = $request->validated();
        
        if (isset($userData['password'])) {
            $userData['password'] = Hash::make($userData['password']);
        } else {
            unset($userData['password']);
        }

        $user->update($userData);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $currentUser = auth()->user();

        if ($currentUser->type === 'admin' && $user->type !== 'restoAdmin') {
            return redirect()->back()->with('error', 'Vous ne pouvez supprimer que des utilisateurs de type restoAdmin.');
        }

        if ($currentUser->type === 'restoAdmin' && !in_array($user->type, ['manager', 'cuisinier'])) {
            return redirect()->back()->with('error', 'Vous ne pouvez supprimer que des utilisateurs de type manager ou cuisinier.');
        }

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
