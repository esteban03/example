<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluationUser extends Model
{

    protected $dates = ['send_at'];

    protected $fillable = [
        'send_at'
    ];

    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
