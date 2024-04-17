<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>{{ $viewData['title'] }}</title>

  <!-- Bootstrap Select -->
  <link rel="stylesheet" href="{{asset('assets/backend/bootstrap-select/dist/css/bootstrap.min.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/bootstrap-select/dist/css/bootstrap-select.min.css ')}}">

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{asset('assets/backend/modules/bootstrap/css/bootstrap.min.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/fontawesome/css/all.min.css ')}}">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/backend/modules/jqvmap/dist/jqvmap.min.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/weather-icon/css/weather-icons.min.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/weather-icon/css/weather-icons-wind.min.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/summernote/summernote-bs4.css ')}}">

  <link rel="stylesheet" href="{{asset('assets/backend/modules/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css')}}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('assets/backend/css/style.css ')}}">
  <link rel="stylesheet" href="{{asset('assets/backend/css/components.css ')}}">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="{{asset('assets/backend/modules/ionicons/css/ionicons.min.css ')}}">

  <!-- Bootstrap-Iconpicker -->
<link rel="stylesheet" href="{{asset('assets/backend/modules/bootstrap-iconpicker/dist/css/bootstrap-iconpicker.min.css ')}}"/>

<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar valider">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>
          <div class="search-element">
            
            <div class="search-backdrop"></div>
            
          </div>
        </form>
        <ul class="navbar-nav navbar-right">
          
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="{{asset('assets/backend/img/avatar/avatar-1.png ')}}" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block">Salut, {{ Auth::user()->name }}</div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Récemment connecté</div>
              <a href="{{route('profile.edit')}}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Profile
              </a>
              <div class="dropdown-divider"></div>
             
              <!-- Authentication -->
              <form method="POST" action="{{ route('logout') }}">
                @csrf

                <a href="{{route('logout')}}" class="dropdown-item has-icon text-danger"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </form>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2 valider">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('dashboard')}}">Tableau de Bord</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Tableau de Bord</li>
            
            <li class=" @if (request()->routeIs('dashboard')) active @endif ">

              <a href="{{ route('dashboard') }}" class="nav-link "><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
             
            </li>
            
            <li class="dropdown @if (request()->routeIs('clients.index', 'clients.create', 'clients.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-ios-people"></i> <span>CLIENTS</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('clients.create')}}">Ajouter un client</a></li>
                <li><a class="nav-link" href="{{route('clients.index')}}">Liste des clients</a></li>
              </ul>
            </li>
            
            <li class="dropdown @if (request()->routeIs('categories.index', 'categories.create', 'categories.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-ios-bookmarks"></i> <span>CATEGORIES ARTICLES</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('categories.create')}}">Ajouter une catégorie</a></li>
                <li><a class="nav-link" href="{{route('categories.index')}}">Liste des catégories</a></li>
              </ul>
            </li>

            <li class="dropdown @if (request()->routeIs('articles.index', 'articles.create', 'articles.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-cube"></i> <span>PRODUITS</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('articles.create')}}">Ajouter un produit</a></li>
                <li><a class="nav-link" href="{{route('articles.index')}}">Liste des produits</a></li>
              </ul>
            </li>

            <li class="dropdown @if (request()->routeIs('approvisionnements.index', 'approvisionnements.create', 'approvisionnements.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-android-arrow-down"></i> <span>ACHATS</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('approvisionnements.create')}}">Ajouter un achat</a></li>
                <li><a class="nav-link" href="{{route('approvisionnements.index')}}">Liste des achats</a></li>
              </ul>
            </li>

            <li class="dropdown @if (request()->routeIs('ventes.index', 'ventes.create', 'ventes.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-android-arrow-up"></i> <span>VENTES</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('ventes.create')}}">Ajouter une vente</a></li>
                <li><a class="nav-link" href="{{route('ventes.index')}}">Historique des ventes</a></li>
              </ul>
            </li>

            <li class="dropdown @if (request()->routeIs('categories-depenses.index', 'categories-depenses.create', 'categories-depenses.edit','depenses.index', 'depenses.create', 'depenses.edit')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-minus-circled"></i> <span>DEPENSES</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('depenses.create')}}">Ajouter des dépenses</a></li>
                <li><a class="nav-link" href="{{ route('depenses.index')}}">Liste des dépenses</a></li>
                <li><a class="nav-link" href="{{ route('categories-depenses.create')}}">Catégories de dépenses</a></li>
              </ul>
            </li>

            <li class="dropdown @if (request()->routeIs('dashboard.clients', 'dashboard.produits', 'dashboard.achats','dashboard.ventes','dashboard.depenses')) active @endif " >
              <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="ion-stats-bars"></i> <span>RAPPORTS</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('dashboard.produits-stat')}}">Statistiques Produits</a></li>
                <li><a class="nav-link" href="{{ route('dashboard.clients')}}">Rapport Clients</a></li>
                <li><a class="nav-link" href="{{ route('dashboard.produits')}}">Rapport de stock</a></li>
                <li><a class="nav-link" href="{{ route('dashboard.achats')}}">Rapports Achats</a></li>
                <li><a class="nav-link" href="{{ route('dashboard.ventes')}}">Rapports Ventes</a></li>
                <li><a class="nav-link" href="{{ route('dashboard.depenses')}}">Rapports Dépenses</a></li>
              </ul>
            </li>
          </ul>
     
        </aside>
      </div>

      @yield('content')

      <footer class="main-footer valider">
        <div class="footer-left">
          Copyright &copy; {{ date('Y') }} <div class="bullet"></div> <a href="pdevtuto.com" target="__blank">Vente Management</a> 
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>

  <style>
    li i{
      font-size: 20px;
    }
  </style>

  <!-- General JS Scripts -->
  <script src="{{asset('assets/backend/modules/jquery.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/popper.js')}}"></script>
  <script src="{{asset('assets/backend/modules/tooltip.js')}}"></script>
  <script src="{{asset('assets/backend/modules/bootstrap/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/nicescroll/jquery.nicescroll.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/moment.min.js')}}"></script>
  <script src="{{asset('assets/backend/js/stisla.js')}}"></script>
  <script src="{{asset('assets/backend/js/bundle.js')}}"></script>

  
  <!-- JS Libraies -->
  <script src="{{asset('assets/backend/modules/simple-weather/jquery.simpleWeather.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/chart.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/jqvmap/dist/jquery.vmap.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
  <script src="{{asset('assets/backend/modules/summernote/summernote-bs4.js')}}"></script>
  <script src="{{asset('assets/backend/modules/chocolat/dist/js/jquery.chocolat.min.js')}}"></script>

  <!-- JS Libraies -->
  <script src="{{asset('assets/backend/modules/datatables/datatables.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/datatables/Select-1.2.4/js/dataTables.select.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{asset('assets/backend/modules/jquery-selectric/jquery.selectric.min.js ')}}"></script>
  <script src="{{asset('assets/backend/modules/upload-preview/assets/js/jquery.uploadPreview.min.js ')}}"></script>
  <script src="{{asset('assets/backend/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js ')}}"></script>

  <!-- Page Specific JS File -->
  <script src="{{asset('assets/backend/js/page/modules-datatables.js')}}"></script>
  <script src="{{asset('assets/backend/js/bootstrap-iconpicker.bundle.min.js')}}"></script>
  <!-- Page Specific JS File -->
  <script src="{{asset('assets/backend/modules/upload-preview/assets/js/jquery.uploadPreview.min.js ')}}"></script>


  <!-- Page Specific JS File -->
  <script src="{{asset('assets/backend/js/page/index-0.js')}}"></script>

  <!-- Template JS File -->
  <script src="{{asset('assets/backend/js/scripts.js')}}"></script>
  <script src="{{asset('assets/backend/js/custom.js')}}"></script>

  <!-- Bootstrap Select -->
  <script src="{{asset('assets/backend/bootstrap-select/dist/js/bootstrap.min.js')}}"></script>
  <script src="{{asset('assets/backend/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
  

  <script>
    $(document).ready(function(){
        $('.print').on('click',function(){
            $('.valider').hide();
            if (!window.print()) {
                $('.valider').show();
            };
        });
    });
  </script>

</body>
</html>