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
                                    Liste des clients                                    
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
                                                    <tr style="font-size: 1em">
                                                        <th>N°</th>
                                                        <th>Nom client</th>
                                                        <th>Numéro téléphone</th>
                                                        <th>Adresse</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size:1em;">
                                                    @php 
                                                      $num = 1;
                                                    @endphp
                                                    
                                                    @forelse ($viewData['clients'] as $client)
                                                        <tr >
                                                            <td>{{ $num++ }}</td>
                                                            <td>{{ $client->nom }}</td>
                                                            <td>{{ $client->telephone }}</td>
                                                            <td>{{ $client->adresse }}</td>                                                            
                                                        </tr>
                                                    @empty
                                                        
                                                    @endforelse

                                                </tbody>
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

