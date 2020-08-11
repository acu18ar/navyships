<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model
{
    protected $table = 'trackers';

    protected $fillable = [
        'numero',
        'buque_id'
    ];

    public function buque() {
        return $this->belongsTo(Buque::class);
    }

    public function positions() {
        return $this->hasMany(Posicion::class);
    }
}
