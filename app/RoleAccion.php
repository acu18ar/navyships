<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoleAccion extends Model
{
    protected $table = 'role_accion';

    protected $fillable = [
        'role_id',
        'accion_id'
    ];
}
