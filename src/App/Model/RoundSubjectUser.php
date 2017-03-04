<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property Round round
 * @property Subject subject
 * @property User user
 */
class RoundSubjectUser extends Model
{
    protected $table = 'round_subject_user';

    protected $primaryKey = 'id';

    protected $fillable = ['value'];

    public $timestamps = false;

    public function round()
    {
        return $this->belongsTo('App\Model\Round');
    }

    public function subject()
    {
        return $this->belongsTo('App\Model\Subject');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}