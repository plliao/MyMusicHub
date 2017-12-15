<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlayList extends Model
{
    //
    protected $table = 'PlayList';
    protected $primaryKey = 'PlayListId';
    public $timestamps = false;
}
