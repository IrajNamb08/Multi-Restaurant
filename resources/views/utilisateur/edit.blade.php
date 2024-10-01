@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-sign-in-alt"></i></p>
        <h3 class="py-1">Modification Utilisateur</h3>
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
        <form action="{{route('users.update',$user->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom">Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="nom" value="{{ old('nom', $user->nom) }}" id="nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" value={{ old('email', $user->email) }} id="email" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe (laisser vide pour ne pas changer)</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password_confirmation">Confirmer le Mot de passe</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="type" class=" form-control-label">Type d'utilisateur</label>
                    <select name="type" id="type" class="form-control">
                        @foreach ($allowedTypes as $type)
                            <option value="{{ $type }}" {{ $user->type == $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                        @endforeach
                    </select>
                </div>
                @if(auth()->user()->type === 'admin')
                    <div class="form-group col-md-4">
                        <label for="restaurant_id" class=" form-control-label">Restaurant</label>
                        <select name="restaurant_id" id="restaurant_id" class="form-control">
                            @foreach($restaurants as $restaurant)
                                <option value="{{ $restaurant->id }}" {{ $user->restaurant_id == $restaurant->id ? 'selected' : '' }}>{{ $restaurant->nom_resto }}</option>
                            @endforeach
                        </select>
                    </div>
                @elseif(auth()->user()->type === 'restoAdmin')
                    <div class="form-group col-md-4">
                        <label for="pointdevente_id" class=" form-control-label">Point de vente</label>
                        <select name="pointdevente_id" id="pointdevente_id" class="form-control">
                            @foreach($pointsDeVente as $pointDeVente)
                                <option value="{{ $pointDeVente->id }}" {{ $user->pointdevente_id == $pointDeVente->id ? 'selected' : '' }}>{{ $pointDeVente->adresse }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Mettre à jour <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection