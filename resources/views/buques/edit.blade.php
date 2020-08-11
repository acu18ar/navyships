@extends('layouts.'.Auth::user()->role->name)
@section('title','Editar Unidad de Superfice')
@section('content')
<div class="card">
    <h2 class="card-header">
        Editar Unidad de Superficie
    </h2>
    <div class="card-body">
    <form method="POST" action="{{ route('buque.update',$buque)  }}">
            @method('PUT')
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5>Unidad de Superficie Existente</h5>
                </div>
            @endif
            <div class="form-group">
                <label for="code">Codigo de Unidad de Superfice</label>
                <input type="text" class="form-control" value="{{$buque->code}}" id="code" name="code" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre de la Unidad de Superfice</label>
                <input type="text" class="form-control" value="{{$buque->nombre}}" id="nombre" name="nombre" required>
            </div>
            <div class="form-group">
                <label for="description">Descripcion</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{$buque->description}}</textarea>
            </div>
            <div class="form-group">
                <label for="localidad_id">Localidad</label>
                <select class="form-control" id="localidad_id" name="localidad_id" required>
                    <option selected="true" disabled="disabled" value="">--Seleccione una Localidad--</option>
                    @foreach($localidades as $localidad)
                        @if($localidad->id == $buque->localidad_id) 
                            <option value="{{ $localidad->id }}" selected>{{ $localidad->nombre }}</option>
                        @else
                            <option value="{{ $localidad->id }}">{{ $localidad->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Actualizar Unidad de Superfice</button>
        </form>
    </div>
</div>
@endsection
