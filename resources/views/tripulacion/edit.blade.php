@extends('layouts.'.Auth::user()->role->name)
@section('title','Registrar Tripulaciones')
@section('content')
<div class="card">
    <h2 class="card-header">
        Editar Tripulacion
    </h2>
    <div class="card-body">
    <form method="POST" action="{{ route('tripulacion.update',$tripulacion)  }}">
            @method('PUT')
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5>Ya existe un Tripulacion Asignada</h5>
                </div>
            @endif
            <div class="form-group">
                <label for="k">Comandante</label>
                <input type="text" class="form-control" value="{{$tripulacion->k}}" id="k" name="k" required>
            </div>
            <div class="form-group">
                <label for="Tripulantes">Tripulacion</label>
                <textarea class="form-control" id="Tripulantes" name="Tripulantes" rows="4">{{$tripulacion->Tripulantes}}</textarea>
            </div>
            <div class="form-group">
                <label for="buque_id">Unidad de Superficie</label>
                <select class="form-control" id="buque_id" name="buque_id" required>
                    <option selected="true" disabled="disabled">--Selecciona UU.SS.--</option>
                    @foreach($buques as $buque)
                        @if($buque->id == $tripulacion->buque_id)
                            <option value="{{ $buque->id }}" selected>{{ $buque->nombre }}</option>
                        @else
                            <option value="{{ $buque->id }}">{{ $buque->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
