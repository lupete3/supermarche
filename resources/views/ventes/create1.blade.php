@extends('layouts.backend')

@php
  use App\Models\Vente;
@endphp

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>{{ $viewData['title'] }}</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></div>
                  <div class="breadcrumb-item"><a href="{{ route('ventes.index')}}">ventes</a></div>
                  <div class="breadcrumb-item">{{ $viewData['title'] }}</div>
                </div>
            </div>

            <div class="section-body ">
            
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-12 align-center">
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
                      <div class="card ">
              
                          <div class="card-header">
                            <h4>{{$viewData['title']}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('ventes.index')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-list-alt"></i> Afficher les ventes </a>
                            </div> 
                          </div>
                          <div class="card-body">
                            <ul class="nav nav-pills" id="myTab3" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Articles</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="commande-tab3" data-toggle="tab" href="#commande3" role="tab" aria-controls="commande" aria-selected="false">COMMANDES ENCOURS</a>
                              </li>
                            </ul>
                              <div class="tab-content" id="myTabContent2">

                                <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                  <form method="post" action="{{ route('ventes.store')}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group">
                                      
                                      <label>Choisir un client</label>
                                      <select name="client_id" class="form-control" id="medicament_id" required>
        
                                        @foreach ($viewData['clients'] as $client)
        
                                          <option value="{{ $client->id }}">{{ $client->nom }}</option>
        
                                        @endforeach
                                      
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      
                                      <label>Choisir un article</label>
                                      <select name="medicament_id" class="form-control" id="medicament_id" required>
        
                                        @foreach ($viewData['medicaments'] as $medicament)
        
                                          <option value="{{ $medicament->id }}">{{ $medicament->designation.' => '.$medicament->prix }}FC</option>
        
                                        @endforeach
                                      
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label>Quantité Achetée</label>
                                      <input type="number" class="form-control" name="quantite" value="{{ old('quantite') }}" placeholder="" required="">
                                    </div>
                                
                                    <div class="card-footer text-right">
                                      <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Enregistrer</button>
                                    </div>
                                  </form>
                                </div>

                                <div class="tab-pane fade" id="commande3" role="tabpanel" aria-labelledby="commande-tab3">
                                  <h4>Commandes Encours</h4>
                                  <div class="row">
                                    @foreach ($viewData['clients_commandes'] as $client)

                                    @php
                                              
                                      $viewData['commandes'] = \DB::table('ventes')
                                        ->select('*')->where('client_id', $client->id)
                                        ->where('status',0)->get();

                                    @endphp

                                      <div class="col-12 col-md-6 col-lg-6">
                                        <div class="card @if (count($viewData['commandes']) > 0) card-danger @else card-success @endif ">
                                          <div class="card-header">
                                            <h4>{{ $client->nom }}</h4>
                                            <div class="card-header-action">
                                              @if (count($viewData['commandes']) > 0)
                                                <a href="{{ route('ventes.print', $client->id)}}" class="btn btn-primary">
                                                  <i class="fas fa-print"></i> Imprimer
                                                </a>
                                              @endif
                                            </div>
                                          </div>
                                          <div class="card-body">

                                            <table class="table table-responsive">

                                              @if (count($viewData['commandes']) > 0)

                                              <th>Produit</th>
                                              <th>Qté</th>
                                              <th>Prix</th>
                                              <th>Prix Total</th>

                                              @endif

                                              @forelse ($viewData['commandes'] as $commande)

                                                <tr>
                                                  <td>{{ $commande->libelle }}</td>
                                                  <td>{{ $commande->quantite }}</td>
                                                  <td>{{ $commande->prix_vente }}FC</td>
                                                  <td><b>{{ $commande->prix_tot }}FC</b></td>
                                                </tr>
                                                

                                              @empty
                                              
                                              @endforelse

                                            </table>
                                            
                                          </div>
                                        </div>
                                      </div>

                                    @endforeach
                                    
                                  </div>
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