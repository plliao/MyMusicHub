<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class SearchResultController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
	public function show(Request $request)
   	{
		$data = Input::all();
		$keyword = '%' . $data['keyword'] . '%';
		$artists = DB::select('select * from Artists where ArtistTitle like ?', [$keyword]);
		$users = DB::select('select * from users where username like ?', [$keyword]);

        $tracks = DB::table(
            'Tracks'
        )->join(
            'AlbumTrack', 'Tracks.TrackId', '=', 'AlbumTrack.TrackId'
        )->join(
            'Albums', 'Albums.AlbumId', '=', 'AlbumTrack.AlbumId'
        )->select(
            'TrackName', 'Tracks.TrackId', 'Albums.AlbumId', 'AlbumName', 'TrackDuration'
        )->where(
            'TrackName', 'like', $keyword
        )->get();

        return view('SearchResultPage', ['result' => $artists,
					 'tracks' => $tracks,
					 'users' =>$users ]);
  	}
}
