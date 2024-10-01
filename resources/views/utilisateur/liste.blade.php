@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Liste des utilisateurs</h3>
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
                <a href="{{route('users.create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-sign-in-alt"></i>Nouveau Accès
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Email</th>
                            <th>Type</th>
                            @if(auth()->user()->type === 'admin')
                                <th>Restaurant</th>
                            @elseif(auth()->user()->type === 'restoAdmin')
                                <th>Point de vente</th>
                            @endif
                            <th scope="col" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)   
                            <tr>
                                <td>
                                    {{$user->nom}}
                                </td>
                                <td>
                                    <span class="block-email">{{$user->email}}</span>
                                </td>
                                <td>{{ $user->type }}</td>
                                @if(auth()->user()->type === 'admin')
                                    <td>{{ $user->restaurant->nom ?? 'N/A' }}</td>
                                @elseif(auth()->user()->type === 'restoAdmin')
                                    <td>{{ $user->pointdevente->adresse ?? 'N/A' }}</td>
                                @endif
                                <td class="actions d-flex justify-content-end">
                                    <a href="" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0 m-0" data-toggle="tooltip" data-placement="top" title="Supprimer">
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