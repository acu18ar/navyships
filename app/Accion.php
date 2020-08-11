<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accion extends Model
{
    protected $table = 'accions';

    protected $fillable = [
        'accionName'
    ];

    public function roles() {
        return $this->belongsToMany(Role::class, 'role_accion');
    }
}
