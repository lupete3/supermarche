

@extends('layouts.backend')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>{{ $viewData['title'] }}</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de Bord</a></div>
                  <div class="breadcrumb-item"><a href="{{ route('ventes.index')}}">Ventes</a></div>
                  <div class="breadcrumb-item">{{ $viewData['title'] }}</div>
                </div>
            </div>

            <div class="section-body ">
            
                <div class="row">
                    <div class="col-12">
                        @if($errors->any())
                            @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h6>
                                {{ $error }}
                                </h6>
                            </div>
                            @endforeach
                        @endif
                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h6>
                                {{ Session::get('success') }}
                            </h6>
                            </div> 
                        @endif
                        <div class="card">
                            <div class="card-header">
                                <h4>{{ $viewData['title'] }} </h4>
                                <div class="card-header-action">
                                    <a href="{{ route('ventes.create')}}" class="btn btn-icon icon-left btn-success"><i class="fas fa-plus"></i> Effectuer une vente</a>
                                </div>   
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>                                 
                                        <tr>
                                            <th>#</th>
                                            <th>Date Vente</th>
                                            <th>Nom Client</th>
                                            <th>Produit</th>
                                            <th>Quantite Achetée</th>
                                            <th>Prix Ventes</th>
                                            <th>Bonus</th>
                                            <th>Coût Total </th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @php
                                            $total = 0;
                                        @endphp

                                        @foreach ($viewData['ventes'] as $vente) 
                                            <tr>
                                                @php
                                                    $total += $vente->prix_tot;
                                                @endphp
                                                <td> {{ $vente->id }} </td>
                                                <td> {{ $vente->created_at }} </td>
                                                <td> {{ $vente->client->nom }} </td>
                                                <td> {{ $vente->libelle }} </td>
                                                <td> {{ $vente->quantite }} </td>
                                                <td> {{ $vente->prix_vente }} Fc</td>
                                                <td> {{ $vente->bonus }}</td>
                                                <td> <b>{{ $vente->prix_tot }} Fc</b></td>
                                                
                                            </tr>
                                        @endforeach
                                        
                                    </tbody>
                                    <h3>Total Vente : {{ $total }} Fc</h3> 
                                </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection