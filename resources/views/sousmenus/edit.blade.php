@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Modification Sous-Menu</h3>
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
        <form action="{{route('sousmenu.update',$sousmenu->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nom_sous_menu">Nom du sous-menu</label>
                    <input type="text" value="{{old('nom_sous_menu', $sousmenu->nom_sous_menu)}}" class="form-control" name="nom_sous_menu" id="nom_sous_menu">
                </div>
                <div class="form-group col-md-4">
                    <label for="menu_id" class=" form-control-label">Tous Menus</label>
                    <select name="menu_id" id="restaurant_id" class="form-control">
                        <option></option>
                        @foreach ($menus as $id => $nom)
                            <option value="{{ $id }}" {{ $id == $sousmenu->menu_id ? 'selected' : '' }}>{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <textarea name="description" class="form-control" id="description" cols="20" rows="5">{{$sousmenu->description}}</textarea>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="image_sous_menu">Image du menu</label>
                    <input type="file" class="form-control-file" name="image_sous_menu" id="image_sous_menu">
                    <img src="{{ $sousmenu->image_sous_menu ? asset('storage/sousmenus/' . $sousmenu->image_sous_menu) : $sousmenu->nom_sous_menu }}" alt="{{ $sousmenu->nom_sous_menu }}" style="height: 50px;width: 50px !important;border-radius: 50%;object-fit: cover;">
                </div>
                <div class="form-group col-md-4">
                    <label for="prix">Prix</label>
                    <input type="text" value="{{old('prix', $sousmenu->prix)}}" class="form-control" name="prix" id="prix">
                </div>
                <div class="form-check col-md-2">
                    <input type="checkbox" class="form-check-input" id="disponibilite" name="disponibilite" {{ $sousmenu->disponibilite ? 'checked' : '' }}>
                    <label class="form-check-label" for="disponibilite">Disponible</label>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Mettre à jour <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection