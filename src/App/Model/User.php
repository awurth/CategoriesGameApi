<?php

namespace App\Model;

use Cartalyst\Sentinel\Users\EloquentUser;

class User extends EloquentUser
{
    protected $table = 'user';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username',
        'email',
        'password',
        'last_name',
        'first_name',
        'permissions',
    ];

    protected $loginNames = ['username', 'email'];

    public function ownGames()
    {
        return $this->hasMany('App\Model\Game', 'user_id');
    }

    public function playedGames()
    {
        return $this->belongsToMany('App\Model\Game');
    }
}
