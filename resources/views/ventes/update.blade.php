@extends('layouts.backend')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>{{ $viewData['title'] }}</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de Bord</a></div>
                  <div class="breadcrumb-item"><a href="{{ route('approvisionnements.index')}}">Aprovisionnements</a></div>
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
                        <form method="post" action="{{ route('approvisionnements.update',$approvisionnement->id)}}" enctype="multipart/form-data">
                          @method('PUT')  
                          @csrf
                          <div class="card-header">
                            <h4>{{$viewData['title']}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('approvisionnements.index')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-list-alt"></i> Afficher les approvisionnements</a>
                            </div> 
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label>Choisir une boisson</label>
                              <select name="boisson_id" class="form-control" id="boisson_id" required>

                                @foreach ($viewData['boissons'] as $boisson)

                                  <option @selected(old('boisson_id', $approvisionnement->boisson_id) == $boisson->id) value="{{ $boisson->id }}" >{{ $boisson->designation }}</option>

                                @endforeach
                               
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Quantité Achetée (bouteilles)</label>
                              <input type="number" class="form-control" name="quantite" value="{{ $approvisionnement->quantite }}" required="">
                            </div>
                            
                            <div class="form-group">
                              <label>Prix Achat($)</label>
                              <input type="text" class="form-control" name="prix_achat" value="{{ $approvisionnement->prix }}" required="">
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Mettre à jour </button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
          </div>
        </section>
    </div>

@endsection