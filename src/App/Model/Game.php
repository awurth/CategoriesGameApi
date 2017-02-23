<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'game';

    protected $primaryKey = 'id';

    protected $fillable = [];

    public function owner()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Model\Subject');
    }

    public function rounds()
    {
        return $this->hasMany('App\Model\Round');
    }
}