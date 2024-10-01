@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Nouveau Restaurant</h3>
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
        <form action="{{route('resto.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom_resto">Nom du restaurant</label>
                    <input type="text" class="form-control" name="nom_resto" id="nom_resto">
                </div>
                <div class="form-group col-md-6">
                    <label for="logo">Logo du restaurant</label>
                    <input type="file" class="form-control-file" name="logo" id="logo">
                </div>
            </div>
 
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Enregistrer <i class="far fa-plus-square"></i></button>
            </div>
            
        </form>
    </div>
@endsection