<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}" >

    <title>@yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery.min.js')}}"></script>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">AGENTE REGIONAL {{$role ?? ''}}</a>
    <h4>dsfsadfasfdsafd</h4>
    <h4>saaaa</h4>
      <ul class="navbar-nav px-3">

        <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{ route('logout') }}">SALIR</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar bg-dark">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Unidades de Superficie</span>
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('buques.index') }}">
                  <span style="color:white;" data-feather="truck"></span>
                  Lista de UU.SS.
                </a>
              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Tripulacion</span><!-- aun se debe ver -->
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="">
                  <span style="color:white;" data-feather="map"></span>
                  Lista de Tripulacion
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="">
                  <span style="color:white;" data-feather="map-pin"></span>
                  Registrar Tripulacion
                </a>
              </li>
              {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Localidades</span>
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('localidades.index') }}">
                  <span style="color:white;" data-feather="command"></span>
                  Lista de Localidades
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('localidad.create') }}">
                  <span style="color:white;" data-feather="plus-circle"></span>
                  Registrar Localidad
                </a>
              </li> --}}
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          @yield('content')
        </main>
      </div>
    </div>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <!-- Icons -->
    <script src="{{asset('js/feather.min.js')}}"></script>
    <script>
      feather.replace()
    </script>
  </body>
</html>
