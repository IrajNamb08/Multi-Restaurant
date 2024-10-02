@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Liste des point de vente {{$restaurant->nom_resto}}</h3>
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
                <a href="{{route('ptvente.create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-sign-in-alt"></i>Nouveau point de vente
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th>Restaurant</th>
                            <th scope="col">Point de vente</th>
                            <th scope="col" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pointdeventes as $pointdevente)   
                            <tr>
                                <td>
                                    <img src="{{ $restaurant->logo ? asset('storage/logos/' . $restaurant->logo) : $restaurant->nom_resto }}" alt="{{ $restaurant->nom_resto }}" style="height: 50px;width: 50px !important;border-radius: 50%;object-fit: cover;">
                                </td>
                                <td>
                                    {{$pointdevente->adresse}}
                                </td>
                                <td class="actions d-flex justify-content-end">
                                    <a href="{{route('ptvente.show',$pointdevente->id)}}" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('ptvente.delete',$pointdevente->id)}}" method="POST">
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