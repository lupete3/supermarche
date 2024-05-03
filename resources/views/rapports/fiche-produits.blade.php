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
                                    Liste des produits                                    
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
                                                        <th>Catégorie</th>
                                                        <th>Designation</th>
                                                        <th>Prix d'achat</th>
                                                        <th>Prix de détail</th>
                                                        <th>En Stock</th>
                                                        <th>Valeur En Stock($)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $num = 1;
                                                    @endphp
                                                    @foreach ($viewData['articles'] as $article) 
                                                        <tr>
            
                                                            <td> {{ $num++ }} </td>
                                                            <td> {{ $article->category->nom }} </td>
                                                            <td> {{ $article->designation }} </td>
                                                            <td> {{ $article->prix_achat }} $</td>
                                                            <td> {{ $article->prix }} $</td>
                                                            <td> {{ $article->solde }} </td>
                                                            <td> {{ $article->prix * $article->solde }} $</td>
                                                            
                                                        </tr>
                                                    @endforeach
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

