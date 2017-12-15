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
		
		$trackinfo = DB::table('Tracks')
        	->join('AlbumTrack', 'Tracks.TrackId', '=', 'AlbumTrack.TrackId')
		->join('Albums', 'AlbumTrack.AlbumId', '=', 'Albums.AlbumId')
                ->where('Tracks.ArtistId','=',[$artistid])
        	->orderBy('AlbumName','desc')
		->get();

        	return view('TracksPage', ['result' => $trackinfo, 'artistname' => $artistname]);
  	}
}
