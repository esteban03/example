<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseUser extends Model
{
    protected $fillable = [
        'user_id','question_id','response'
    ];
}
