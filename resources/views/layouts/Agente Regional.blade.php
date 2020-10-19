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
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">TNR-TRACKER Agente Regional</a>
      <ul class="nav nav-tabs">
        <li class="nav-item dropdown">
            <a class="nav-link"  role="button" aria-haspopup="true" aria-expanded="false" href="{{ route('buques.index') }}" style="color:white;">
                {{-- <span style="color:white;" data-feather="ship"></span> --}}
                <i style="color:white;" class="fas fa-ship"></i>
                Unidades de Superficie</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color:white;">
                <i style="color:white;" class="fas fa-user-cog"></i>Tripulacion</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{route('tripulacion.index')}}"> Lista de Tripulacion</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{route('tripulacion.create')}}">Registrar Tripulacion</a>
            </div>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" style="color:white;">
                <i style="color:white;" class="fas fa-pager"></i>Tracker</a>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="{{ route('trackers.index') }}"> Lista de Trackers</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="{{ route('tracker.create') }}">Registrar Trackers</a>
            </div>
          </li>
        <li class="nav-item text-nowrap">
        <a class="nav-link" href="{{ route('logout') }} " style="color:white;">SALIR</a>
        </li>
      </ul>
    </nav>



    <div class="container-fluid">


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
