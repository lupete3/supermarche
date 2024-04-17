@extends('layouts.backend')

@section('content')

    <!-- Main Content -->
    <div class="main-content">
        
        <section class="section">
            <div class="section-header">
                <h1>{{ $viewData['title'] }}</h1>
                <div class="section-header-breadcrumb">
                  <div class="breadcrumb-item active"><a href="{{ route('dashboard') }}">Tableau de Bord</a></div>
                  <div class="breadcrumb-item"><a href="{{ route('depenses.index')}}">Dépenses</a></div>
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
                        <form method="post" action="{{ route('depenses.update',$depense->id)}}" enctype="multipart/form-data">
                          @method('PUT')  
                          @csrf
                          <div class="card-header">
                            <h4>{{$viewData['title']}}</h4>
                            <div class="card-header-action">
                                <a href="{{ route('depenses.index')}}" class="btn btn-icon icon-left btn-info"><i class="fas fa-list-alt"></i> Afficher les dépenses</a>
                            </div> 
                          </div>
                          <div class="card-body">
                            <div class="form-group">
                              <label>Choisir une catégorie de dépense</label>
                              <select name="category_id" class="form-control selectpicker" id="category_id" data-live-search="true" required>

                                @foreach ($viewData['categoriesDepenses'] as $categoryDepense)

                                  <option data-tokens="{{ $categoryDepense->nom }}" @selected(old('category_id', $depense->category_id ) == $categoryDepense->id)  value="{{ $categoryDepense->id }}">{{ $categoryDepense->nom }}</option>

                                @endforeach
                               
                              </select>
                            </div>

                            <div class="form-group">
                              <label>Destination:*</label>
                              <input type="text" class="form-control" name="name" value="{{ $depense->personne }}" required="">
                            </div>
                            
                            <div class="form-group">
                              <label>Montant:*</label>
                              <input type="text" class="form-control" name="montant" value="{{ $depense->montant }}" required="">
                            </div>

                            <div class="form-group">
                              <label>Date:*</label>
                              <input type="datetime-local" class="form-control" name="date" value="{{ $depense->date_depense }}" required="">
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