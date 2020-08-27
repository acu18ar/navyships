<!doctype html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="{{asset('js/all.min.js')}}"></script>
    <link rel="icon" href="{{ asset('favicon.ico') }}" >

    <title>@yield('title')</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/dashboard.css')}}" rel="stylesheet">

    <script src="{{asset('js/jquery.min.js')}}"></script>
  </head>

  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">TNR-TRACKER root</a>
      <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span style="color:white;" data-feather="users"></span>Usuarios</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('users.index') }}">Lista de Usuarios</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('user.create') }}">Registrar Usuarios</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <span style="color:white;" data-feather="map"></span>Localidades</a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="{{ route('localidades.index') }}">Lista de Localidades</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('localidad.create') }}">Registrar Localidad</a>
          </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                {{-- <span style="color:white;" data-feather="ship"></span> --}}
                <i style="color:white;" class="fas fa-ship"></i>
                Unidades de Superficie</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('buques.index') }}">Lista de UU.SS.</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('buque.create') }}">Registrar UU.SS.</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i style="color:white;" class="fas fa-user-cog"></i>Tripulacion</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{route('tripulacion.index')}}"> Lista de Tripulacion</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('tripulacion.create')}}">Registrar Tripulacion</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <i style="color:white;" class="fas fa-pager"></i>Tracker</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('trackers.index') }}"> Lista de Trackers</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('tracker.create') }}">Registrar Trackers</a>
            </div>
          </li>
        <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{ route('logout') }}">SALIR</a>
        </li>
      </ul>
    </nav>

{{-- Desde AQUI --}}



{{-- HASTA AQUI --}}

    <div class="container-fluid">

        {{-- <nav class="col-md-2 d-none d-md-block bg-light sidebar bg-dark">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Acciones-Rol</span><!--Solo ve el administrador a los usuarios -->
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('acciones.index') }}">
                  <span style="color:white;" data-feather="user-plus"></span>
                  Acciones por Role
                </a>

              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Usuarios</span><!--Solo ve el administrador a los usuarios -->
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('users.index') }}">
                  <span style="color:white;" data-feather="users"></span>
                  Lista de Usuarios
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('user.create') }}">
                  <span style="color:white;" data-feather="user-plus"></span>
                  Registrar Usuarios
                </a>
              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Unidades de Superficie</span>
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('buques.index') }}">
                  <span style="color:white;" data-feather="truck"></span>
                  Lista de UU.SS.
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('buque.create') }}">
                  <span style="color:white;" data-feather="plus-square"></span>
                  Registrar UU.SS.
                </a>
              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Tripulacion</span><!-- aun se debe ver -->
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{route('tripulacion.index')}}">
                  <span style="color:white;" data-feather="map"></span>
                  Lista de Tripulacion
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{route('tripulacion.create')}}">
                  <span style="color:white;" data-feather="map-pin"></span>
                  Registrar Tripulacion
                </a>
              </li>
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span style="color:white;">Tracker</span>
              </h6>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('trackers.index') }}">
                  <span style="color:white;" data-feather="command"></span>
                  Lista de Trackers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('tracker.create') }}">
                  <span style="color:white;" data-feather="plus-circle"></span>
                  Registrar Tracker
                </a>
              </li>
            </ul>
          </div>
        </nav> --}}

        <main role="main" >
          @yield('content')
        </main>

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
