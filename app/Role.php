<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'rol'
    ];

    public function accions() {
        return $this->belongsToMany(Accion::class, 'role_accion');
    }

    public function users() {
        return $this->hasMany(User::class);
    }
}
