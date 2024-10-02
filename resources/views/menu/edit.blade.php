@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Modification Menu</h3>
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
        <form action="{{route('menu.update',$menu->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="menu">Nom du menu</label>
                    <input type="text" class="form-control" value="{{old('menu', $menu->menu)}}" name="menu" id="menus">
                </div>
                <div class="form-group col-md-6">
                    <label for="image_menu">Image du menu</label>
                    <input type="file" class="form-control-file" name="image_menu" id="image_menu">
                    <img src="{{ asset('storage/menus/' . $menu->image_menu) }}" width="100" alt="{{ $menu->menu }}">
                </div>
            </div>
 
            <div class="form-group text-right">
                <button type="submit" class="btn-submit">Mettre à jour <i class="far fa-plus-square"></i></button>
            </div>
        </form>
    </div>
@endsection