<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posicion;

class PosicionController extends Controller
{
    public function store($data) {
        $message=base64_decode($data);
        $message = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $message);
        $datos=explode("/",$message);
        Posicion::create([
            'lat' => $datos[1],
            'lon' => $datos[2],
            'tracker_id' => $datos[0],
            'fh_posicion' => $datos[3]
        ]);
        return "OK";
    }
    public function store2($id,$lat,$lon) {
        Posicion::create([
            'lat' => $lat,
            'lon' => $lon,
            'tracker_id' => $id
        ]);
        return "OK";
    }
    public function store3($id,$lat,$lon,$fh, $vel) {
        Posicion::create([
            'lat' => $lat,
            'lon' => $lon,
            'tracker_id' => $id,
            'fh_posicion' => $fh,
            'vel' => $vel
        ]);
        return "OK";
    }
}
