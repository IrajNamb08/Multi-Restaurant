@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-sign-in-alt"></i></p>
        <h3 class="py-1">Nouveau Utilisateur</h3>
        @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <hr>
        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom">Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="nom" id="nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmer le Mot de passe</label>
                    <input type="password_confirmation" class="form-control" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type" class=" form-control-label">Type d'utilisateur</label>
                    <select name="type" id="type" class="form-control">
                        <option></option>
                        @foreach ($allowedTypes as $type)
                            <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->type === 'admin')
                    <div class="form-group col-md-4">
                        <label for="restaurant_id" class=" form-control-label">Restaurant</label>
                        <select name="restaurant_id" id="restaurant_id" class="form-control">
                            <option></option>
                            @foreach ($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}">{{ $restaurant->nom_resto }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif(auth()->user()->type === 'restoAdmin')
                    <div class="form-group col-md-4">
                        <label for="pointdevente_id" class=" form-control-label">Point de vente</label>
                        <select name="pointdevente_id" id="pointdevente_id" class="form-control">
                            <option></option>
                            @foreach ($pointsDeVente as $pointDeVente)
                                <option value="{{ $pointDeVente->id }}">{{ $pointDeVente->adresse }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Enregistrer <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection