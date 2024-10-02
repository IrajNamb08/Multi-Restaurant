@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="table-container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3>Liste des tables de {{$restaurant->nom_resto}} à <small>{{$pointdevente->adresse}}</small>  </h3>
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
                <a href="{{route('table.create')}}">
                    <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                        <i class="fas fa-sign-in-alt"></i>Nouveau Table
                    </button>
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Numéro table</th>
                            <th scope="col">QR Code</th>
                            <th scope="col" class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tables as $table)   
                            <tr>
                                <td>
                                    {{$table->numero_table}}
                                </td>
                                <td>
                                    @if($table->qr_code)
                                        <img src="{{ asset('storage/' . $table->qr_code) }}" alt="QR Code" width="100">
                                    @else
                                        Pas de QR code
                                    @endif
                                </td>
                                <td class="actions d-flex justify-content-end">
                                    <a href="{{route('table.show',$table->id)}}" data-toggle="tooltip" data-placement="top" title="Modifier">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <form action="{{route('table.delete',$table->id)}}" method="POST">
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