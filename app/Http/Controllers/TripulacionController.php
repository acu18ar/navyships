<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tripulacion;
use App\Buque;

class TripulacionController extends Controller
{
    //
    public function index() {
        $tripulaciones=Tripulacion::all();
        return view('tripulacion.index',compact('tripulaciones'));
    }

    public function create() {
        $buques=Buque::all();
        return view('tripulacion.create',compact('buques'));
    }

    public function store(Request $request) {
        $data=$request->all();
        Tripulacion::create($data);
        return redirect()->route('tripulacion.index');
    }

    public function edit(Tripulacion $tripulacion) {
        $buques=Buque::all();
        return view('tripulacion.edit',compact('tripulacion','buques'));
    }

    public function update(Request $request, Tripulacion $tripulacion) {
        $data=$request->all();
        $tripulacion->update($data);
        return redirect()->route('tripulacion.index');
    }

    public function destroy(Tripulacion $tripulacion) {
        $tripulacion->delete();
        return redirect()->route('tripulacion.index');
    }

}
