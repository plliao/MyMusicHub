<?php

namespace App\Http\Controllers;

use Auth;
use App\PlayListTrack;
use App\PlaybyPlayList;
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

        return view(
            'PlayerPage', 
            [
                'TrackInfo' => $TrackInfo,
                'PlayList'=> $Playlist
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
        return redirect()->route('PlayerPage', [ 'TrackId' => $data['TrackId']]);
    }
}
