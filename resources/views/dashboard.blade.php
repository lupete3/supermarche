@extends('layouts.backend')

@php
  use Carbon\Carbon;
@endphp

@section('content')
    
    <!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Tableau de bord</h1>
          </div>

          <div class="row">
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="ion-android-arrow-down"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Achats Journaliers </h4>
                  </div>
                  <div class="card-body">
                    
                    {{ $viewData['approvisionnements'] }}Fc

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="ion-android-arrow-up text-white" ></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Ventes Journalières</h4>
                  </div>
                  <div class="card-body">
                    
                    {{ $viewData['ventes'] }}Fc

                  </div>
                </div>
              </div>
            </div>  
            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-dark">
                  <i class="ion-minus-circled text-white" ></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Dépenses Journalières</h4>
                  </div>
                  <div class="card-body">
                    
                    {{ $viewData['depenses'] }}Fc

                  </div>
                </div>
              </div>
            </div>   
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="ion-ios-people"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Clients</h4>
                  </div>
                  <div class="card-body">

                    {{ count( $viewData['clients']) }}

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="ion-cube"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Articles</h4>
                  </div>
                  <div class="card-body">
                    
                    {{ count($viewData['articles']) }}

                  </div>
                </div>
              </div>
            </div>               
          </div>
          
        </section>
      </div>

@endsection

<style>
  .card-icon i{
    font-size: 20px;
    color: white;
    font-size: 30px;
  }
  .card-icon{
    padding-top: 25px;
  }
  
</style>