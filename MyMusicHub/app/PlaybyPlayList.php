<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlaybyPlayList extends Model
{
    //
    protected $table = 'PlaybyPlayList';
    protected $primaryKey = array('username', 'TrackId', 'playtime');
    public $timestamps = false;
}
