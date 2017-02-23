<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subject';

    protected $primaryKey = 'id';

    protected $fillable = ['name'];

    public function games()
    {
        return $this->belongsToMany('App\Model\Game');
    }
}