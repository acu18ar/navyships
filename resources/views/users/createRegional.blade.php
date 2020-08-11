@extends('layouts.'.Auth::user()->role->name)
@section('title','Registrar Usuario')
@section('content')
<div class="card">
    <h2 class="card-header">
        Asignar Localidades al Usuario
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('localidad.user.store')  }}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="localidades">Seleccione una o mas Localidades</label>
                <select multiple class="form-control" id="localidades" name="localidades[]" required>
                    @foreach($localidades as $localidad)
                        <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <input type="hidden" name="user_id" value="{{ $user->id }}">
            <button type="submit" class="btn btn-block btn-primary">Finalizar</button>
        </form>
    </div>
</div>
@endsection