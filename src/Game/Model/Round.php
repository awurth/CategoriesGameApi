<?php

namespace App\Game\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Game       game
 * @property Collection values
 */
class Round extends Model
{
    protected $table = 'round';

    protected $primaryKey = 'id';

    protected $fillable = ['letter', 'finished'];

    public function game()
    {
        return $this->belongsTo('App\Game\Model\Game');
    }

    public function values()
    {
        return $this->hasMany('App\Game\Model\RoundSubjectUser');
    }
}