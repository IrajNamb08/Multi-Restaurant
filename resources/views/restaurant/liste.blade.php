@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Liste des restaurant</h3>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('delete'))
                    <div class="alert alert-danger">
                        {{ session('delete') }}
                    </div>
                @endif
                <a href="{{route('resto.create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-sign-in-alt"></i>Nouveau restaurant
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Restaurant</th>
                            <th scope="col">Logo</th>
                            <th scope="col" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($restaurants as $restaurant)   
                            <tr>
                                <td>
                                    {{$restaurant->nom_resto}}
                                </td>
                                <td>
                                    <img src="{{ $restaurant->logo ? asset('storage/logos/' . $restaurant->logo) : $restaurant->nom_resto }}" alt="{{ $restaurant->nom_resto }}" style="height: 50px;width: 50px !important;border-radius: 50%;object-fit: cover;">
                                </td>
                                <td class="actions d-flex justify-content-end">
                                    <a href="{{route('resto.show',$restaurant->id)}}" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('resto.delete',$restaurant->id)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0" data-toggle="tooltip" data-placement="top" title="Supprimer"
                                            onclick="return confirm('Voulez-vous continuer la suppression ?');">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection