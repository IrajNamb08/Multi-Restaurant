@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3><small>Sous-Menu du</small> {{$restaurant->nom_resto}}</h3>
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
                <a href="{{route('sousmenu.create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-sign-in-alt"></i>Nouveau Sous-Menu 
                    </button>
                </a>
            </div>
            <form action="{{ route('sousmenu.index') }}" method="GET" class="mb-4">
                <div class="row">
                    <div class="col-md-6">
                        <select name="menu_id" class="form-control">
                            <option value="">Tous les menus</option>
                            @foreach($menus as $id => $nom)
                                <option value="{{ $id }}" {{ request('menu_id') == $id ? 'selected' : '' }}>{{ $nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Rechercher</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Plat</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Description</th>
                            <th scope="col" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sousMenus as $sousMenu)   
                            <tr>
                                <td>
                                    <img src="{{ $sousMenu->image_sous_menu ? asset('storage/sousmenus/' . $sousMenu->image_sous_menu) : $sousMenu->nom_sous_menu }}" alt="{{ $sousMenu->nom_sous_menu }}" style="height: 50px;width: 50px !important;border-radius: 50%;object-fit: cover;">
                                </td>
                                <td>
                                    {{$sousMenu->nom_sous_menu}}
                                </td>
                                <td>
                                    {{number_format($sousMenu->prix,2)}} Ar
                                </td>
                                <td>
                                    {{$sousMenu->description}}
                                </td>
                                <td class="actions d-flex justify-content-end">
                                    <a href="{{route('sousmenu.show',$sousMenu->id)}}" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('sousmenu.delete',$sousMenu->id)}}" method="POST">
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