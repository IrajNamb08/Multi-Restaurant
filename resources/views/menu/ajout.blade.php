@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Nouveau Menu</h3>
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
        <form action="{{route('menu.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="menu">Nom du menu</label>
                    <input type="text" class="form-control" name="menu" id="menu">
                </div>
                <div class="form-group col-md-6">
                    <label for="image_menu">Image du menu</label>
                    <input type="file" class="form-control-file" name="image_menu" id="image_menu">
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Enregistrer <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection