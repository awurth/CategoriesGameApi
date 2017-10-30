<?php

namespace App\Game\Model;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Collection games
 * @property Collection values
 */
class Subject extends Model
{
    protected $table = 'subject';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function games()
    {
        return $this->belongsToMany('App\Game\Model\Game');
    }

    public function values()
    {
        return $this->hasMany('App\Game\Model\RoundSubjectUser');
    }
}