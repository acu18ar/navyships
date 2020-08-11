<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    protected $table = 'localidades';

    protected $fillable = [
        'nombre'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'locations_user');
    }

    public function buque() {
        return $this->hasMany(Buque::class);
    }
}
