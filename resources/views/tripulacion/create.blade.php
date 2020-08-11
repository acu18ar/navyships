@extends('layouts.'.Auth::user()->role->name)
@section('title','Registrar Tripulaciones')
@section('content')
<div class="card">
    <h2 class="card-header">
        Registrar Tripulacion
    </h2>
    <div class="card-body">
    <form method="POST" action="{{ route('tripulacion.store')  }}">
            {{csrf_field()}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5>Ya existe un Tripulacion Asignada</h5>
                </div>
            @endif
            <div class="form-group">
                <label for="k">Comandante</label>
                <input type="text" class="form-control" id="k" name="k" required>
            </div>
            <div class="form-group">
                <label for="Tripulantes">Tripulacion</label>
                <textarea class="form-control" id="Tripulantes" name="Tripulantes" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label for="buque_id">Unidad de Superficie</label>
                <select class="form-control" id="buque_id" name="buque_id" required>
                    <option selected="true" disabled="disabled">--Selecciona UU.SS.--</option>
                    @foreach($buques as $buque)
                        <option value="{{ $buque->id }}">{{ $buque->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
