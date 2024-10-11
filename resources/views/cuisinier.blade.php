@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title text-uppercase text-center">Listes des commandes {{$restaurant->nom_resto}}
            <br> <small>{{$pointdeVente->adresse}}</small>
          </h4>
          <div class="table-responsive">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>N°Commande</th>
                  <th>N°Table</th>
                  <th>Plats</th>
                  <th>Emplacement</th>
                  <th>Prix Total</th>
                  <th>Note</th>
                  <th>État</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($commandes as $commande) 
                  <tr>
                    <td>{{$commande->numeroCommande}}</td>
                    <td>{{$commande->tableRestaurant->numero_table}}</td>
                    <td>
                      <ul>
                        @foreach ($commande->sousmenuCommandes as $item )
                          <li>{{ $item->sousMenu->nom_sous_menu }} (x{{ $item->quantite }})</li>
                        @endforeach
                      </ul>
                    </td>
                    <td>
                      @if($commande->emplacement == 0)
                        <span class="badge badge-success">Sur place</span>
                      @else
                        <span class="badge badge-info">À emporter</span>
                      @endif
                    </td>
                    <td>{{$commande->total}} Ar</td>
                    <td>{{$commande->note}}</td>
                    <td>
                      <select class="form-control etat-commande" data-commande-id="{{ $commande->id }}">
                        <option value="reçu" {{ $commande->etat == 'reçu' ? 'selected' : '' }}>Reçu</option>
                        <option value="en_preparation" {{ $commande->etat == 'en_preparation' ? 'selected' : '' }}>En préparation</option>
                        <option value="pret_a_livrer" {{ $commande->etat == 'pret_a_livrer' ? 'selected' : '' }}>Prêt à livrer</option>
                        <option value="annule" {{ $commande->etat == 'annule' ? 'selected' : '' }}>Annulé</option>
                      </select>
                      <span class="badge badge-{{ getBadgeClass($commande->etat) }} etat-badge text-uppercase" style="width: 150px;height:20px">{{ ucfirst($commande->etat) }}</span>
                    </td>
                    <td>
                      <button class="btn btn-warning btn-sm voir-commande" data-commande-id="{{ $commande->id }}"><i class="fas fa-eye"></i></button>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->

@endsection