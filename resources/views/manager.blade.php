@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fas fa-table"></i>
                    </div>
                    <div class="text">
                        <h2>{{$tables->count()}}</h2>
                        <span>Tables</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="far fa-building"></i>
                    </div>
                    <div class="text">
                        <h2>{{$totalEnCours}}</h2>
                        <span>Commande en cours</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="text">
                        <h2>{{$totalEnPreparation}}</h2>
                        <span>Commande en préparation</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <div class="text">
                        <h2>{{$totalPretALivrer}}</h2>
                        <span>Commande prêt à livrer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><br>
<div class="row">
    <div class="col-md-6">
        <!-- TOP CAMPAIGN-->
        <div class="top-campaign">
            <h3 class="title-3 m-b-30">5 dernières commandes prêtes à livre</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                        @foreach($dernieresCommandesPretALivrer as $commande)
                            <tr>
                                <td>{{ $commande->numeroCommande }}</td>
                                <td>{{ $commande->tableRestaurant->numero_table }}</td>
                                <td>{{ $commande->updated_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--  END TOP CAMPAIGN-->
    </div>
</div>
@endsection
