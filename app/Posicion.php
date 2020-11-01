<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    protected $table = 'posiciones';

    protected $fillable = [
        'lat',
        'lon',
        'tracker_id',
        'fh_posicion',
        'vel'

    ];

    public function tracker() {
        return $this->belongTo(Tracker::class);
    }
}
