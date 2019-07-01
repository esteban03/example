<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{

    protected $fillable = [
        'title','user_id'
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // TODO: retirar condicion para unificar
    public function user_evaluation()
    {
        $user = auth()->user();
        return $this->belongsToMany(User::class, 'evaluation_users')
            ->where( 'user_id', $user->id);
    }

    public function evaluateds()
    {
        return $this->belongsToMany(User::class, 'evaluation_users')
                    ->withPivot('send_at');
    }

}
