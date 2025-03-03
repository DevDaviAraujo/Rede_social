<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UsersInfo extends Model
{

    protected $table = 'users_info';
    protected $fillable = [

        'id',
        'users_id',
        'name',
        'last_name',
        'gender',
        'phone_number',
        'created_at',
        'updated_at'

    ];
}
