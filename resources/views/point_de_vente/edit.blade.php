@extends('layouts.admin')
@section('content')
    <div class="form-container">
        <p><i class="fas fa-user-plus" ></i></p>
        <h3 class="py-1">Modification Point de vente</h3>
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
        <form action="{{route('ptvente.update',$pointdevente->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-row align-items-end">
                <div class="form-group col-md-6">
                    <label for="adresse">Adresse</label>
                    <input type="text" class="form-control" value="{{old('adresse', $pointdevente->adresse)}}" name="adresse" id="adresse">
                </div>
                <div class="form-group col-md-6 text-right ">
                    <button type="submit" class="btn-submit">Mettre à jour <i class="far fa-plus-square"></i></button>
                </div>
            </div>
        </form>
    </div>
@endsection