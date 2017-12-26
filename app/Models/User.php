<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    const NORM_POINT = 700;
    const TYPES = [
        'student'   => 1,
        'lecturer'  => 2
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'type',
        'email',
        'password',
        'point',
        'api_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function updateToken()
    {
        $this->update(['api_token' => str_random(50)]);

        return $this;
    }

    public function logout()
    {
        $this->updateToken();
    }

    public function getPointCoefficientAttribute()
    {
        return self::NORM_POINT / $this->point;
    }
}
