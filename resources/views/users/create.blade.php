@extends('layouts.'.Auth::user()->role->name)
@section('title','Registrar Usuario')
@section('content')
<div class="card">
    <h2 class="card-header">
        Registrar Usuario
    </h2>
    <div class="card-body">
        <form method="POST" action="{{ route('user.store')  }}">
            {{csrf_field()}}
            <div class="form-group">
                <label for="username">Nombre de Usuario</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Correo Electronico</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" pattern="[A-Za-z][A-Za-z0-9]*[0-9][A-Za-z0-9]*" title="Una contraseña válida es un conjuto de caracteres, donde cada uno consiste de una letra mayúscula o minúscula, o un dígito. La contraseña debe empezar con una letra y contener al menor un dígito" required>
            </div>
            <div class="form-group">
                <label for="grado">Grado</label>
                <select class="form-control" id="grado" name="grado" required>
                    <option selected="true" disabled="disabled">--Seleccione un Grado--</option>
                    <option value="Almirante">Almirante</option>
                    <option value="Vice Almirante">Vice Almirante</option>
                    <option value="Contra Almirante">Contra Almirante</option>
                    <option value="Capitán de Navío">Capitán de Navío</option>
                    <option value="Capitán de Fragata">Capitán de Fragata</option>
                    <option value="Capitán de Corbeta">Capitán de Corbeta</option>
                    <option value="Teniente de Navío">Teniente de Navío</option>
                    <option value="Teniente de Fragata">Teniente de Fragata</option>
                    <option value="Alferez">Alferez</option>
                    <option value="SO. Mtre.">SO. Mtre.</option>
                    <option value="SO. My.">SO. My.</option>
                    <option value="SO. 1.">SO. 1.</option>
                    <option value="SO. 2.">SO. 2.</option>
                    <option value="SO. I.">SO. I.</option>
                    <option value="SG. 1.">SG. 1.</option>
                    <option value="SG. 2.">SG. 2.</option>
                    <option value="SG. I.">SG. I.</option>
                </select>
            </div>
            <div class="form-group">
                <label for="first_name">Nombres</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Apellidos</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="role_id">Rol</label>
                <select class="form-control" id="role_id" name="role_id">
                    <option selected="true" disabled="disabled">--Seleccione un Rol--</option>
                    @foreach($roles as $rol)
                        <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-block btn-primary">Registrar</button>
        </form>
    </div>
</div>
@endsection
