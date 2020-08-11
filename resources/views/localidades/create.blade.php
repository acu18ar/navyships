@extends('layouts.'.Auth::user()->role->name)
@section('title','Registrar Localidad')
@section('content')
<div class="card">
    <h2 class="card-header">
        Registrar Localidad
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('localidad.store')  }}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="nombre">Nombre Localidad</label>
                <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection