<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationUser extends Model
{
    protected $table = 'location_user';

    protected $fillable = [
        'user_id',
        'location_id'
    ];
}
