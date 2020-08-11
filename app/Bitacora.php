<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    protected $table = 'bitacoras';

    protected $fillable = [
        'username',
        'accion',
        'name_table',
        'data_new',
        'data_old',
        'data_Bitacora',
        'sesion_Bitacora',
        'Bitacoracol'
    ];
}
