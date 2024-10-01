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
                            @if($currentUser->type === 'admin' || $currentUser->type === 0)
                                <th>Restaurant</th>
                            @elseif($currentUser->type === 'restoAdmin' || $currentUser->type === 1)
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
                                <td>{{ is_numeric($user->type) ? ['admin', 'restoAdmin', 'manager', 'cuisinier'][$user->type] : $user->type }}</td>
                                @if($currentUser->type === 'admin' || $currentUser->type === 0)
                                    <td>{{ $user->restaurant->nom_resto ?? 'N/A' }}</td>
                                @elseif($currentUser->type === 'restoAdmin' || $currentUser->type === 1)
                                    <td>{{ $user->pointdevente->adresse ?? 'N/A' }}</td>
                                @endif
                                <td class="actions d-flex justify-content-end">
                                    <a href="{{route('users.show',$user->id)}}" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('users.destroy',$user->id)}}" method="POST">
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