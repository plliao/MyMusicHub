<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PlayerController extends Controller
{
    //
	public function play(Request $request)
    	{
		$TrackId = $request->input('TrackId');
		$TrackInfo = DB::select('select * from Tracks where TrackId =?', [$TrackId]);
        	return view('PlayerPage', ['TrackInfo' => $TrackInfo]);
  	}
}
