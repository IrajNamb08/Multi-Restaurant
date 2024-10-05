@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Nouveau Sous-Menu</h3>
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
        <form action="{{route('sousmenu.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="nom_sous_menu">Nom du sous-menu</label>
                    <input type="text" class="form-control" name="nom_sous_menu" id="nom_sous_menu">
                </div>
                <div class="form-group col-md-4">
                    <label for="menu_id" class=" form-control-label">Tous Menus</label>
                    <select name="menu_id" id="restaurant_id" class="form-control">
                        <option></option>
                        @foreach ($menus as $id => $nom)
                            <option value="{{ $id }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <textarea name="description" class="form-control" id="description" cols="20" rows="5"></textarea>
                </div>
                
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="image_sous_menu">Image du menu</label>
                    <input type="file" class="form-control-file" name="image_sous_menu" id="image_sous_menu">
                </div>
                <div class="form-group col-md-4">
                    <label for="prix">Prix</label>
                    <input type="text" class="form-control" name="prix" id="prix">
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Enregistrer <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection