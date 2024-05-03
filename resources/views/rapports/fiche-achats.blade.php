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
                                    Liste des achats                                    
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
                                                        <th>Produit</th>
                                                        <th>Quantite Achetée</th>
                                                        <th>Prix Achats</th>
                                                        <th>Coût Total</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $num = 1;
                                                        $total = 0;
                                                    @endphp
                                                    @foreach ($viewData['approvisionnements'] as $approvisionnement) 
                                                        <tr>
                                                            @php
                                                                $total =+ $approvisionnement->prix_total;
                                                            @endphp
                                                            <td> {{ $num++ }} </td>
                                                            <td> {{ $approvisionnement->article->designation }} </td>
                                                            <td> {{ $approvisionnement->quantite }} </td>
                                                            <td> {{ $approvisionnement->prix }} $</td>
                                                            <td> {{ $approvisionnement->prix_total }} $</td>
                                                            
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                                <h5>Total Achats : {{ $total }} $</h5>
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

