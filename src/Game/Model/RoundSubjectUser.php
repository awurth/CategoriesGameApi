<?php

namespace App\Game\Model;

use App\Security\Model\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property Round   round
 * @property Subject subject
 * @property User    user
 */
class RoundSubjectUser extends Model
{
    protected $table = 'round_subject_user';

    protected $primaryKey = 'id';

    protected $fillable = ['value'];

    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo('App\Game\Model\Round');
    }

    public function subject()
    {
        return $this->belongsTo('App\Game\Model\Subject');
    }

    public function user()
    {
        return $this->belongsTo('App\Security\Model\User');
    }
}