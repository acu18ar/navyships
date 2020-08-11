<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tripulacion extends Model
{
    protected $table = 'tripulacions';

    protected $fillable = [
        'k',
        'Tripulantes',
        'buque_id'
    ];

    public function buque() {
        return $this->belongsTo(Buque::class);
    }
}
