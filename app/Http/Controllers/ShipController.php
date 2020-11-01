<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Buque;
use App\Localidad;
use App\Posicion; //ojo importante>

class ShipController extends Controller
{
    // para emplear los buques aqui...

    public function index() {
        $buques=Buque::all();
        return view('buques.index',compact('buques'));
    }
    public function index2() {
        $buques=Buque::all();
        return view('buques.index2',compact('buques'));
    }

    public function view(Buque $buque) {
        return view('buques.view',compact('buque'));
    }
    public function viewRep(Buque $buque) {
        return view('buques.viewRep',compact('buque'));
    }

    public function create() {
        $localidades=Localidad::all();
        return view('buques.create',compact('localidades'));
    }

    public function store(Request $request) {
        $data=$request->all();
        Buque::create($data);
        // return redirect()->route('buques.index');
        return redirect()->route('trackers.index');
    }

    public function edit(Buque $buque) {
        $localidades = Localidad::all();
        return view('buques.edit',compact('buque','localidades'));
    }

    public function update(Request $request, Buque $buque) {
        $data=$request->all();
        $buque->update($data);
        return redirect()->route('buques.index');
    }

    public function destroy(Buque $buque) {
        $buque->delete();
        return redirect()->route('buque.index');
    }


    // aca modificaremos para la fh actual

    public function getDates(Buque $buque) {
        $hist=Posicion::where('tracker_id',$buque->tracker->id)->orderBy('created_at', 'desc')->take(10)->get();
        return $hist;
    }

    public function getRange(Buque $buque, $from, $to){
        $registros = Posicion::where('tracker_id',$buque->tracker->id)->where('created_at', '>=', date($from))->where('created_at','<=', date($to));
        return $registros->get(); //para rep fechas
    }
}
