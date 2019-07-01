<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'evaluation_id','category_id','question'
    ];

    public function answers()
    {
        return $this->hasMany(ResponseUser::class);
    }

    public function answer()
    {
        return $this->hasOne(ResponseUser::class);
    }

    public function category()
    {
        return $this->belongsTo(CategoryQuestion::class);
    }

    public function evaluation()
    {
        return $this->hasOne(Evaluation::class);
    }

}
