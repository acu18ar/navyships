@extends('layouts.'.Auth::user()->role->name)
@section('title','Editar Trackers')
@section('content')
<div class="card">
    <h2 class="card-header">
        Editar Trackers
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('tracker.update',$tracker)  }}">
            @method('PUT')
            @csrf
            @if($errors->any())
                <div class="alert alert-danger">
                    <h5>Ya existe el Tracker</h5>
                </div>
            @endif
            <div class="form-group">
                <label for="numero">Numero telefonico asignado</label>
                <input type="text" class="form-control" value="{{$tracker->numero}}" id="numero" name="numero" required>
            </div>
            <div class="form-group">
                <label for="buque_id">Unidad de Superficie</label>
                <select class="form-control" id="buque_id" name="buque_id" required>
                    <option selected="true" disabled="disabled">--Selecciona UU.SS.--</option>
                    @foreach($buques as $buque)
                        @if ($buque->id==$tracker->buque_id)
                            <option value="{{ $buque->id }}" selected>{{ $buque->nombre }}</option>
                        @else
                            <option value="{{ $buque->id }}">{{ $buque->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Actualizar Tracker</button>
        </form>
    </div>
</div>
@endsection
