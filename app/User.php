<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function isJefatura(Type $var = null)
    {
        return $this->rol->name === 'jefatura';
    }

    public function hasRole(array $rols)
    {
        foreach ($rols as $rol) {
            if ($rol === $this->rol->name) {
                return true;
            }
        }
        return false;
    }

    public function isEvaluator()
    {
        return $this->hasRole(['jefatura']);
    }

    public function isAdmin()
    {
        return $this->hasRole(['admin']);
    }


    /******************************+
     *********** relations ********
     ******************************/
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }

    public function evaluation()
    {
        return $this->belongsToMany(Evaluation::class, 'evaluation_users')
            ->withPivot('evaluation_id');
    }

}
