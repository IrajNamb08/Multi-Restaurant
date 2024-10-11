@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="zmdi zmdi-pin-drop"></i>
                    </div>
                    <div class="text">
                        <h2>{{$pointdeventes->count()}}</h2>
                        <span>Points de vente</span>
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
                        <i class="zmdi zmdi-face"></i>
                    </div>
                    <div class="text">
                        <h2>{{$managerCount}}</h2>
                        <span>Manager</span>
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
                        <i class="zmdi zmdi-accounts-list-alt"></i>
                    </div>
                    <div class="text">
                        <h2>{{$cuisinierCount}}</h2>
                        <span>Cuisinier</span>
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
                        <i class="zmdi zmdi-calendar-check"></i>
                    </div>
                    <div class="text">
                        <h2>{{$todayOrdersCount}}</h2>
                        <span>Commande aujourd'hui</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <br>
<div class="row">
    <div class="col-md-6">
        <!-- TOP CAMPAIGN-->
        <div class="top-campaign">
            <h3 class="title-3 m-b-30">Chiffres d'affaires au total</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                        @foreach ($pointdeventes as $pointdevente )   
                            <tr>
                                <td>{{$pointdevente->adresse}}</td>
                                <td>{{ number_format($pointdevente->chiffre_affaires_total,2) ?? 0 }} Ar</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--  END TOP CAMPAIGN-->
    </div>
    <div class="col-md-6">
        <!-- TOP CAMPAIGN-->
        <div class="top-campaign">
            <h3 class="title-3 m-b-30">Chiffres d'affaires aujourd'hui</h3>
            <div class="table-responsive">
                <table class="table table-top-campaign">
                    <tbody>
                        @foreach ($pointdeventes as $pointdevente )   
                            <tr>
                                <td>{{$pointdevente->adresse}}</td>
                                <td>{{ number_format($pointdevente->chiffre_affaires_aujourd_hui,2) ?? 0 }} Ar</td>
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