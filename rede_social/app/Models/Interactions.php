<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Users;

class Interactions extends Model
{
    protected $fillable = [

        'user_id',
        'interaction_type',
        'interaction_id',
        'created_at',
        'updated_at'

    ];

    public function user() {

        return  User::where('id', $this->user_id)->get();

    }


}
