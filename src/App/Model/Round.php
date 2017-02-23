<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $table = 'round';

    protected $primaryKey = 'id';

    protected $fillable = ['letter'];

    public function game()
    {
        return $this->belongsTo('App\Model\Game');
    }
}