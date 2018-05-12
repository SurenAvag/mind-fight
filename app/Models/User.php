<?php

namespace App\Models;

use App\Models\Fragments\User\Getters;
use App\Models\Fragments\User\Relations;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property mixed rating
 * @property mixed pivot
 */
class User extends Authenticatable
{
    use Notifiable, Getters, Relations;

    const NORMAL_EXPERIENCE = 400;

    const NORM_POINT = 700;
    const TYPES = [
        'student'   => 1,
        'lecturer'  => 2
    ];

    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'type',
        'email',
        'password',
        'rating',
        'api_token'
    ];

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
}
