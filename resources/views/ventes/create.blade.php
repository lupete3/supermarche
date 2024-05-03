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

              @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible" id="msg" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h6>
                      {{ Session::get('error') }}
                    </h6>
                </div>
              @endif
              @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible" id="msg" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h6>
                    {{ Session::get('success') }}
                  </h6>
                </div> 
              @endif
            
              <div class="row">
                <!-- Colonne des articles -->
                <div class="col-md-5">
                  <!-- Ajoutez les articles de la catégorie sélectionnée -->
                  <div class="card">
                    <div class="card-body">
                      <form method="post" action="{{ route('ventes.addToCart')}}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                          
                          <label>Choisir un article</label>
                          <select name="article_id" class="form-control selectpicker" id="article_id" data-show-subtext="true" data-live-search="true" required>

                            @foreach ($viewData['articles'] as $article)

                              <option value="{{ $article->id }}">{{ $article->designation.' => '.$article->prix }}$</option>

                            @endforeach
                          
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Quantité Achetée</label>
                          <input type="text" class="form-control" name="quantite" value="{{ old('quantite') }}" placeholder="" required="">
                        </div>
                    
                        <div class="card-footer text-right">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Enregistrer</button>
                        </div>
                      </form>
                    </div>
                  </div>
                  <!-- Ajoutez plus d'articles selon le même modèle -->
                  
                </div>

                <!-- Colonne des catégories -->
                <div class="col-md-7">
                  <div class="row">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>Article</th>
                          <th>Quantité</th>
                          <th>Prix</th>
                          <th>Total</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $totalAmount = 0; // Initialise le montant total à zéro
                        @endphp
                        @foreach(session('cart', []) as $productId => $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>{{ $item['price'] }}</td>
                                @php
                                    $subtotal = $item['quantity'] * $item['price'];
                                    $totalAmount += $subtotal; // Met à jour le montant total
                                @endphp
                                <td>{{ $subtotal }}</td>
                                <td>
                                  <form action="{{ route('ventes.removeFromCart') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="article_id" value="{{ $productId }}">
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-times"></i></button>
                                  </form>
                                </td>
                              </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                        <tr>
                            <td colspan="3"><h6>Total à payer</h6></td>
                            <td><h6>{{ $totalAmount }} $</h6></td>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                  <div class="row" style="margin-top: 50px">
                    <button  class="btn btn-success col-md-3 mt-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-credit-card"></i> Prodéder au paiement</button>
                    <form action="{{ route('ventes.clearCart') }}" class="col-md-3 mt-2" method="post">
                        @csrf
                        <button class="btn btn-danger col-md-12 "><i class="fas fa-trash"> </i> Annuler</button>
                    </form>
                  </div>
                </div>
              </div>
                
            </div>
        </section>
    </div>

    <!-- Critere selon vehicule -->
    <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Choisir un client à facturer</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="row" action="{{ route('ventes.print')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group col-12 col-md-12 col-lg-12">
                <label for="">Choisir un client*</label>
                <select name="client_id" class="form-control selectpicker" id="article_id" data-live-search="true" required>

                  @foreach ($viewData['clients'] as $client)

                    <option data-tokens="{{ $client->nom }}" value="{{ $client->id }}">{{ $client->nom }}</option>

                  @endforeach
                          
                </select>
              </div>  
              <div class="form-group col-12 col-md-12 col-lg-12">

                <label for="">Montant payé*</label>
                <input type="text" class="form-control" value="" name="montant">
                          
              </div>  
              <div class="form-group col-12 col-md-12 col-lg-12">

                <label for="">Montant de Reduction*</label>
                <input type="text" class="form-control" value="0" name="reduction">
                          
              </div>  
              <div class="form-group col-12 col-md-12 col-lg-12">
                <button type="button" class="btn btn-info btn-sm" id="modal-2" data-toggle="modal" data-target="#exampleModalClient">Ajouter un client</button>
              </div>       
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary  valider">Valider</button>
          </div>
        </div>
      </form>
      </div>
    </div>

    <!-- Critere selon vehicule -->
    <div class="modal" id="exampleModalClient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un client </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="row" action="{{ route('clients.store')}}" enctype="multipart/form-data">
              @csrf
              <div class="form-group col-12 col-md-12 col-lg-12">
                <input type="hidden" name="from" value="pos">
                <div class="form-group">
                  <label>Noms</label>
                  <input type="text" class="form-control" name="nom" value="{{ old('nom') }}" placeholder="" required="">
                </div>
                <div class="form-group">
                  <label>Téléphone</label>
                  <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" placeholder="" required="">
                </div>
                <div class="form-group">
                  <label>Adresse</label>
                  <input type="text" class="form-control" name="adresse" value="{{ old('email') }}" placeholder="" required="">
                </div>
              </div>        
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary  valider">Valider</button>
          </div>
        </div>
      </form>
      </div>
    </div>

@endsection