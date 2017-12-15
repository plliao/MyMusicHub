<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ArtistController extends Controller
{
    //
	public function show(Request $request)
    	{
		$artistid = $request->input('ArtistId');
		$artistname = $request->input('ArtistTitle');

		$tracks = DB::select('select * from Tracks where ArtistId = ?', [$artistid]);

        	return view('TracksPage', ['result' => $tracks, 'artistname' => $artistname]);
  	}
}
