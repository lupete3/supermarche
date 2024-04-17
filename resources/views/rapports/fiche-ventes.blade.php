@extends('layouts.backend')

@section('content')
<style>
  td,th{
    font-size:1em;
    
  }
</style>


    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header valider">
                
            </div>

            <div class="section-body ">
            
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 align-center">
                       
                      <div class="row" style="margin-bottom:10px;  " >
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <center>
                                <p style="font-weight:bold; font-family:Century Gothic; font-size:1em;" >
                                    Liste des ventes                                    
                                </p>
                            </center>        
                        </div>
                        
                      </div>

                      <div class="container">
                        <div class="row" style="margin-bottom:10px;  " >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                                <div class="container">
                                    <div class="row spacer" style="margin-bottom:20px; " >
            
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered table-striped table-sm" style="font-size: 1em">
                                                <thead>                                 
                                                    <tr>
                                                        <th>N°</th>
                                                        <th>Date Vente</th>
                                                        <th>Nom Client</th>
                                                        <th>Produit</th>
                                                        <th>Quantite Achetée</th>
                                                        <th>Bonus</th>
                                                        <th>Prix Ventes</th>
                                                        <th>Coût Total </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
            
                                                    @php
                                                        $num = 1;
                                                        $total = 0;
                                                    @endphp
            
                                                    @foreach ($viewData['ventes'] as $vente) 
                                                        <tr>
                                                            @php
                                                                $total += $vente->prix_tot;
                                                            @endphp
                                                            <td> {{ $num++ }} </td>
                                                            <td> {{ $vente->created_at }} </td>
                                                            <td> {{ $vente->client->nom }} </td>
                                                            <td> {{ $vente->libelle }} </td>
                                                            <td> {{ $vente->quantite }} </td>
                                                            <td> {{ $vente->bonus }}</td>
                                                            <td> {{ $vente->prix_vente }} Fc</td>
                                                            <td> <b>{{ $vente->prix_tot }} Fc</b></td>
                                                            
                                                        </tr>
                                                    @endforeach
                                                    
                                                </tbody>
                                                <h5>Total Ventes : {{ $total }} Fc</h5>
                                            </table>
                                        </div>
            
                                    </div>
                                            
                                </div>             
            
                                <div class="row">
                                 
                                 
                                  <div class="col-md-3 offset-3">
                                    <button type="button" class="btn btn-primary print pull-right valider"><span class="fa fa-print"></span> Imprimer</button>
                                  </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

<style>
  th,td{font-size: 2em;}
</style>

