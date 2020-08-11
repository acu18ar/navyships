
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('favicon.ico') }}">

    <title>TNR-TRACKER</title>
    <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('css/signin.css')}}" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" action="{{route('enter.system')}}" method="POST">
        {{csrf_field()}}
        <img class="mb-4" src="{{ asset('img/estnr.JPG')}}" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">TNR - TRACKER</h1>
        @if(!empty($error))
            <div class="alert alert-danger">
                <h6>{{$error}}</h6>
            </div>
        @endif
        <label for="username" class="sr-only">Nombre de Usuario</label>
        <input type="text" id="username" name="username" class="form-control" placeholder="Nombre de Usuario" required autofocus>
        <label for="password" class="sr-only">Contraseña</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Contraseña" required>
        <button class="btn btn-lg btn-primary btn-block" type="submit">INICIAR SESIÓN</button>
        <p class="mt-5 mb-3 text-muted">&copy; TRANSNAVAL 2020</p>
    </form>
  </body>
</html>
