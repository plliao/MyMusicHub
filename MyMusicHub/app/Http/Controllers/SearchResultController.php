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
		
		$tracks = DB::select('select * from Tracks where TrackName like ?', [$keyword]);

		$users = DB::select('select * from users where username like ?', [$keyword]);

        return view('SearchResultPage', ['result' => $artists,
					 'tracks' => $tracks,
					 'users' =>$users ]);
  	}
}
