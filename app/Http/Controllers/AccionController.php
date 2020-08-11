<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Accion;
use App\Role;

class AccionController extends Controller
{
    public function index() {
        $roles=Role::all();
        return view('acciones.index',compact('roles'));
    }

    public function edit(Role $role) {
        return view('acciones.edit',compact('role'));
    }

    public function update(Request $request, Accion $accion) {
        $data=$request->all();
        $accion->update($data);
        return redirect()->route('accion.index');
    }
}
