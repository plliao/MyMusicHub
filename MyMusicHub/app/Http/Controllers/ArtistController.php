<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
use Auth;

class ArtistController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
    //
	public function show(Request $request)
    {
		$artistid = $request->input('ArtistId');
		$artistname = $request->input('ArtistTitle');
		
		$artist = DB::select(
            'select * from Artists where ArtistId = ?', 
            [$artistid]
        )[0];
		
		$trackinfo = DB::table('Tracks')
        ->join('AlbumTrack', 'Tracks.TrackId', '=', 'AlbumTrack.TrackId')
		->join('Albums', 'AlbumTrack.AlbumId', '=', 'Albums.AlbumId')
        ->where('Tracks.ArtistId','=',[$artistid])
        ->orderBy('AlbumName','desc')
		->get();

        $likes = DB::table(
            'Likes'
        )->where(
            'Likes.username', '=', Auth::user()->username
        )->where(
            'Likes.ArtistId', '=', $artistid
        )->get();

        return view(
            'TracksPage', 
            [
                'result' => $trackinfo, 
                'artist' => $artist,
                'likes' => $likes
            ]
        );
  	}

    public function like(Request $request)
    {
		$data = Input::all();

		$artistTitle = DB::select(
            'select ArtistTitle from Artists where ArtistId = ?', 
            [$data['ArtistId']]
        )[0]->ArtistTitle;

        $likes = DB::table(
            'Likes'
        )->where(
            'Likes.username', '=', Auth::user()->username
        )->where(
            'Likes.ArtistId', '=', $data['ArtistId']
        )->first();

        if ($data['like']==1 and !$likes) 
        {
            DB::table(
                'Likes'
            )->insert(
                [
                    'username' => Auth::user()->username,
                    'ArtistId' => $data['ArtistId'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
            session(['status' => 'You like '. $artistTitle . '!!']);
        }
        else if ($data['like']==0 and $likes)
        {
            DB::table(
                'Likes'
            )->where(
                'Likes.username', '=', Auth::user()->username
            )->where(
                'Likes.ArtistId', '=', $data['ArtistId']
            )->delete();
            session(['status' => 'You don\'t like '. $artistTitle . '!!']);
        }

        return redirect()->route(
            'TracksPage', 
            [ 
                'ArtistId' => $data['ArtistId'],
                'ArtistTitle' => $artistTitle
            ]
        );
    }
}
