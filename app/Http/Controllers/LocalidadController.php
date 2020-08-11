<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Localidad;

class LocalidadController extends Controller
{
    public function index() {
        $localidades=Localidad::all();
        return view('localidades.index',compact('localidades'));
    }

    public function create() {
        return view('localidades.create');
    }

    public function store(Request $request) {
        $data=$request->all();
        Localidad::create($data);
        return redirect()->route('localidades.index');
    }

    public function edit(Localidad $localidad) {
        return view('localidades.edit',compact('localidad'));
    }

    public function update(Request $request, Localidad $localidad) {
        $data=$request->all();
        $localidad->update($data);
        return redirect()->route('localidades.index');
    }

    public function destroy(Localidad $localidad) {
        $localidad->delete();
        return redirect()->route('localidades.index');
    }
}
