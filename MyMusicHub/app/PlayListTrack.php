<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayListTrack extends Model
{
    //
    protected $table = 'PlayListTrack';
    protected $primaryKey = array('PlayListId', 'TrackId', 'PlayListOrder');
    public $timestamps = false;
    protected $fillable = [
            'PlayListId', 'TrackId', 'PlayListOrder'
    ];
}
