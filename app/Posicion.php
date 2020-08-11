<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posicion extends Model
{
    protected $table = 'posiciones';

    protected $fillable = [
        'lat',
        'lon',
        'tracker_id'
    ];

    public function tracker() {
        return $this->belongTo(Tracker::class);
    }
}
