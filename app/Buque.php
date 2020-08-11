<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buque extends Model
{
    protected $table = 'buques';

    protected $fillable = [
        'code',
        'nombre',
        'description',
        'localidad_id'
    ];

    public function localidad() {
        return $this->belongsTo(Localidad::class);
    }

    public function tracker() {
        return $this->hasOne(Tracker::class);
    }

    public function tripulacion() {
        return $this->hasMany(Tripulacion::class);
    }
}
