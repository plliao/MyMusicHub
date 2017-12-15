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
        //$rate = new Rating;

        //print_r($rate->getKeyName());
        $rate = Rating::firstOrNew(
            ['username' => Auth::user()->username],
            ['TrackId' => $data['TrackId']]
        );
        $rate->rating = $data['rate'];
        $rate->save();
        session(['status' => 'Rating has been updated.']);
        return redirect()->route('PlayerPage', [ 'TrackId' => $data['TrackId']]);
    }
}
