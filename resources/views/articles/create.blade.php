@extends('layouts.backend')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>{{ $viewData['title'] }}</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de bord</a></div>
                  <div class="breadcrumb-item"><a href="{{ route('articles.index')}}">Articles</a></div>
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
                        <form method="post" action="{{ route('articles.store')}}" enctype="multipart/form-data">
                            @csrf
                          <div class="card-header">
                            <h4>{{$viewData['title']}}</h4>
                            <div class="card-header-action">
                              <button type="button" class="btn btn-icon icon-left btn-success" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-upload"></i> Importer les articles</button>
                              <a href="{{ route('articles.index')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-list-alt"></i> Afficher les articles</a>
                            </div> 
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label>Choisir une catégorie</label>
                              <select name="category_id" class="form-control selectpicker" id="category_id" data-live-search="true" required>

                                @foreach ($viewData['categories'] as $category)

                                  <option data-tokens="{{ $category->nom }}"  value="{{ $category->id }}">{{ $category->nom }}</option>

                                @endforeach
                               
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Designation</label>
                              <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="" required="">
                            </div>
                          
                            <div class="form-group">
                              <label>Prix d'achat</label>
                              <input type="text" class="form-control" name="prix_achat" value="{{ old('prix_achat') }}" placeholder="" required="">
                            </div>
                          
                            <div class="form-group">
                              <label>Prix de détail($)</label>
                              <input type="text" class="form-control" name="prix" value="{{ old('prix') }}" placeholder="" required="">
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Enregistrer</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
          </div>
        </section>
    </div>


     <!-- Critere selon date -->
     <div class="modal" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ajouter un produit</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fermer">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form method="post" class="row" action="{{ route('articles.import') }}" enctype="multipart/form-data">
              @csrf
              <label>Votre fichier doit avoir des données rangées comme suit</label>
              <table class="table table-small" >
                <th>Designation</th>
                <th>Prix</th>
                <th>Solde en stock</th>
                <th>Num Catégorie</th>
              </table>

              <div class="form-group col-12 col-md-12 col-lg-12">
                <input type="file" class="form-control" name="file" accept=".xlsx, .xls" required="">
              </div>
           
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            <button type="submit" class="btn btn-primary  valider">Ajouter</button>
          </div>
        </div>
      </form>
      </div>
   </div>

@endsection