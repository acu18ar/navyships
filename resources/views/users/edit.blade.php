@extends('layouts.'.Auth::user()->role->name)
@section('title','Editar Usuario')
@section('content')
<div class="card">
    <h2 class="card-header">
        Editar Usuario
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('user.update',$user)  }}">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" value="{{$user->username}}" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico</label>
                <input type="email" class="form-control" value="{{$user->email}}" id="email" name="email" required>
            </div>
            {{-- falta editar la contrasena --}}
            {{-- <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" value="{{$user->password}}" id="password" name="password" required>
            </div> --}}
            <div class="form-group">
                <label for="first_name">Nombres</label>
                <input type="text" class="form-control" value="{{$user->first_name}}" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Apellidos</label>
                <input type="text" class="form-control" value="{{$user->last_name}}" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="role_id">Rol</label>
                <select class="form-control" id="role_id" name="role_id">
                    <option selected="true" disabled="disabled">--Seleccione un Rol--</option>
                    @foreach($roles as $rol)
                        @if($user->role_id==$rol->id)
                            <option value="{{ $rol->id }}" selected>{{ $rol->name }}</option>
                        @else
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Actualizar</button>
        </form>
    </div>
</div>
@endsection
