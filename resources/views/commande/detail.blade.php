<h2>Commande #{{ $commande->numeroCommande }}</h2>
<p><strong>Table:</strong> {{ $commande->tableRestaurant->numero_table }}</p>
<p><strong>État:</strong> {{ ucfirst($commande->etat) }}</p>
<p><strong>Total:</strong> {{ number_format($commande->total,2) }} Ar</p>
<p><strong>Note:</strong> {{ $commande->note ?: 'Aucune note' }}</p>
<p><strong>Emplacement:</strong> {{ $commande->emplacement == 0 ? 'Sur place':  'À emporter' }}</p>

<h3>Plats commandés:</h3>
<div class="row">
    @foreach ($commande->sousmenuCommandes as $item)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ asset('storage/sousmenus/' . $item->sousMenu->image_sous_menu) }}" class="card-img-top" alt="{{ $item->sousMenu->nom_sous_menu }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $item->sousMenu->nom_sous_menu }}</h5>
                    <p class="card-text">Quantité: {{ $item->quantite }}</p>
                    <p class="card-text">Prix unitaire: {{ number_format($item->sousMenu->prix,2) }} Ar</p>
                </div>
            </div>
        </div>
    @endforeach
</div>