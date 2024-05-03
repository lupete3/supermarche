@extends('layouts.backend')

@php
    use App\Models\Vente;

@endphp

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
                              <p style="font-weight:bold; font-family:Century Gothic; font-size:2em;" >
                                <b>MAISON CALEB</b>
                              </p>
                                <p style="font-weight:bold; font-family:Century Gothic; font-size:1em;" >
									RCCM: CD, BKV, RCCM14-A-0098, AV: P.E.L., C. IBANDA, LABOTTE No. O53<br>
                  No: IMPOT D76104A, ID. NAT 5-93N58991Q <br> 
                                    TEL : (+243) 810264833, BUKAVU / RDC <br>
                                    <span>E-mail :  
                                        <a href="#" style="text-decoration:underline">kalebofernand@gmail.com</a> 
                                    </span><br>
                                    
                                </p>
                            </center>        
                        </div>
                        
                      </div>

                      <div class="container">
                        <div class="row" style="margin-bottom:10px;  " >
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            
                                <p style="font-family:Century Gothic; font-size:1em; text-align:center; font-weight:bold;">
                                    Facture N° : 
                                    @php
                                        $tot = Vente::count();

                                        echo '#F'.$tot+1;
                                    @endphp
                                     
                                </p>
                                
                                <p style="font-family:Century Gothic; font-size:1em; margin-left:20px; ">
                                    Date : <?php echo date('d-m-Y'); ?>
                                    <br>
                                    <span>Heure : <?php echo date('H:i'); ?></span>
                                     <br>
                        
                                </p>
                                
                                
                                <p style="font-family:Century Gothic; font-size:1em; text-align:center; font-weight:bold;">
                                    Client : {{ $client->nom }}
                                </p>
            
                                <div class="container">
                                    <div class="row spacer" style="margin-bottom:20px; " >
            
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <table class="table table-bordered table-striped table-sm" style="font-size: 1em">
                                                <thead>
                                                    <tr style="font-size: 1em">
                                                        <th>N°</th>
                                                        <th>Désignation</th>
                                                        <th>Qté</th>
                                                        <th>PU</th>
                                                        <th>TP</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody style="font-size:1em;">
                                                    @php 
                                                      $num = 1;
                                                    @endphp
                                                    
                                                    @php
                                                        $totalAmount = 0; // Initialise le montant total à zéro
                                                    @endphp
                                                    @foreach(session('cart', []) as $productId => $item)
                                                        <tr >
                                                          <td>{{ $num++ }}</td>
                                                          <td>{{ $item['name'] }}</td>
                                                          <td>{{ $item['quantity'] }}</td>
                                                            <td>{{ $item['price'] }}</td>
                                                            @php
                                                                $subtotal = $item['quantity'] * $item['price'];
                                                                $totalAmount += $subtotal; // Met à jour le montant total
                                                            @endphp
                                                            <td>{{ $subtotal }}</td>
                                                            
                                                          </tr>
                                                    @endforeach

                                                    @php
                                                      $num++;
                                                    @endphp
                                                </tbody>
                                            </table>
                                        </div>
            
                                    </div>
                                
                                    <div class="row spacer" style="margin-bottom: 1.3em;">
            
                                      <table class="container-fluid">
                                        <tr class="">
                                          <td class="text-center" style="font-size:1em;">
                                            <p class="" style="font-family:Century Gothic; ">
                                              
                                              Montant HT : 
                                              @php 
                                              
                                                $tva=$totalAmount*0.16;
                                                echo $totalAmount-$tva.' $';
            
                                              @endphp 
                                            <br>
                                            <span>TVA : +<?php echo $tva.' $'; ?>(16%)</span>
                                             <br>
                                             <span><strong>Net à payé : {{ $totalAmount }}$</strong></span><br>
                                             <span><strong>Reduction : {{ $reduction }}$</strong></span><br>
                                             <span><strong>Net payé : {{ $montant }}$</strong></span><br>
                                            </p>
                                          </td>
                                      </table>
                                </div> 
            
                                <div class="container-fluid">
                                  <div class="row">
                                    <center style="width: 100%;">
                                      <span class="title text-center" style="font-size:1em; font-family: century Gothic; font-weight: bold;" >
                                        Merci pour votre visite !</span><br> 
            
                                      <p class="text-center" style="font-size:1em; font-family: century Gothic">
                                        Copyright &copy; Pdevtuto
                                      </p>
                                    </center>
                                  </div>
                                </div>                        
            
                                <div class="row">
                                  <div class="col-md-3 valider">
                                    <form  method="GET" action="{{ route('ventes.paiements',$client->id) }}" class="was-validated">
                                      @csrf
                                      <div class="input-group">
                                        <input type="hidden" name="total" value="{{ $totalAmount }}">
                                        <input type="hidden" name="montant" value="{{ $montant }}">
                                        <input type="hidden" name="reduction" value="{{ $reduction }}">
                                        <button type="submit" class="btn btn-info  pull-right"> <i class="fa fa-check"></i> Confirmer le paiement</button> 
                                      </div>
                                    </form>
                                  </div>
                                  <div class="col-md-3 valider">
                                    <a href="{{ route('ventes.create') }}"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-back"></i> Retour</button></a>
                                  </div>
                                  <div class="col-md-3 offset-3">
                                    <button type="button" class="btn btn-primary print pull-right valider"><span class="fa fa-print"></span> Imprimer</button>
                                  </div>
                                  </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" style=""></div>   
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

