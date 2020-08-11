@extends('layouts.'.Auth::user()->role->name)
@section('title','Editar Localidad')
@section('content')
<div class="card">
    <h2 class="card-header">
        Editar Localidad
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('localidad.update',$localidad)  }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="nombre">Nombre Localidad</label>
                <input type="text" class="form-control" value="{{$localidad->nombre}}" id="nombre" name="nombre" required>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection