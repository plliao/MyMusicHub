<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'Rating';
    protected $primaryKey = array('username', 'TrackId');
    public $incrementing = false;
    protected $fillable = [
        'username', 'TrackId', 'rating'
    ];
}
