<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property User owner
 * @property Collection players
 * @property Collection subjects
 * @property Collection rounds
 * @property Collection values
 */
class Game extends Model
{
    protected $table = 'game';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public function owner()
    {
        return $this->belongsTo('App\Model\User', 'user_id');
    }

    public function players()
    {
        return $this->belongsToMany('App\Model\User');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Model\Subject');
    }

    public function rounds()
    {
        return $this->hasMany('App\Model\Round');
    }

    public function values()
    {
        return $this->hasManyThrough('App\Model\RoundSubjectUser', 'App\Model\Round');
    }
}