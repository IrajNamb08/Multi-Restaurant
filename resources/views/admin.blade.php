@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-sm-6 col-lg-3">
        <div class="overview-item ">
            <div class="overview__inner">
                <div class="overview-box clearfix">
                    <div class="icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <div class="text text-uppercase">
                        <h2>{{$restaurant}}</h2>
                        <span>Restaurants membres</span>
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
                        <i class="zmdi zmdi-money"></i>
                    </div>
                    <div class="text text-uppercase">
                        <h2>{{number_format($revenueMensuel,2)}} Ar</h2>
                        <span>Revenue mensuel</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
