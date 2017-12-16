<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\Rating;
use App\PlayListTrack;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use DB;

class PlayerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
	public function play(Request $request)
    {
		
		$TrackId = $request->input('TrackId');
		$PlayListId = $request->input('PlayListId');
		$AlbumId = $request->input('AlbumId');

		if (!is_null($PlayListId)){
			 DB::table(
               		 'PlaybyPlayList'
            		)->insert(
                		[
                    		 'username' => Auth::user()->username,
                   		 'TrackId' => $TrackId,
                   		 'playtime' => date('Y-m-d H:i:s'),
                    		 'PlayListId' => $PlayListId
                		]
            		);
		}
		else if(!is_null($AlbumId)){
			 DB::table(
               		 'PlaybyAlbum'
            		)->insert(
                		[
                    		 'username' => Auth::user()->username,
                   		 'TrackId' => $TrackId,
                   		 'playtime' => date('Y-m-d H:i:s'),
                    		 'AlbumId' => $AlbumId
                		]
            		);
		}
		
        if (empty($TrackId))
            return redirect()->route('home');
		$TrackInfo = DB::select('select * from Tracks where TrackId =?', [$TrackId]);
        $Playlist = DB::table(
            'PlayList'
        )->select(
            'PlayList.PlayListId', 'PlayList.title'
        )->where(
            'PlayList.username', '=', Auth::user()->username
        )->get();
        
        $rate = DB::table(
            'Rating'
        )->where(
            'Rating.username', '=', Auth::user()->username
        )->where(
            'Rating.TrackId', '=', $TrackId
        )->select(
            'Rating.rating'
        )->get();

        return view(
            'PlayerPage', 
            [
                'TrackInfo' => $TrackInfo,
                'PlayList'=> $Playlist,
                'Rating' => $rate
            ]
        );
  	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$data = Input::all();
        $order = DB::table(
            'PlayListTrack'
        )->where(
            'PlayListTrack.PlayListId', '=', $data['PlayListId']
        )->count();
        
        DB::table('PlayListTrack')->insert(
            [
                'PlayListId' => $data['PlayListId'],
                'TrackId' => $data['TrackId'],
                'PlayListOrder' => $order
            ]
        ); 
        session(['status' => 'Track has been added.']);
        return redirect()->route('PlayerPage', [ 'TrackId' => $data['TrackId']]);
    }

    public function rate(Request $request)
    {
		$data = Input::all();
        $rate = DB::table(
            'Rating'
        )->where(
            'Rating.username', '=', Auth::user()->username
        )->where(
            'Rating.TrackId', '=', $data['TrackId']
        )->select(
            'Rating.rating'
        )->get();

        if ($rate->isEmpty()) 
        {
            DB::table(
                'Rating'
            )->insert(
                [
                    'username' => Auth::user()->username,
                    'TrackId' => $data['TrackId'],
                    'rating' => $data['rate'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
            session(['status' => 'Rating has been added.']);
        }
        else 
        {
            DB::table(
                'Rating'
            )->where(
                'Rating.username', '=', Auth::user()->username
            )->where(
                'Rating.TrackId', '=', $data['TrackId']
            )->update(
                [
                    'rating' => $data['rate'], 
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
            session(['status' => 'Rating has been updated.']);
        }

        return redirect()->route('PlayerPage', [ 'TrackId' => $data['TrackId']]);
    }
}
