<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{

    protected $table = 'user_info';
    protected $fillable = [

        'id',
        'user_id',
        'name',
        'last_name',
        'gender',
        'phone_number',
        'created_at',
        'updated_at'

    ];
}
