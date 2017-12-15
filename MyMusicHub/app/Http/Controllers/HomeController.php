<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	$username = Auth::user()->username ;
	$userinfo = DB::select('select * from users where username = ?', [$username]);
    $playList = DB::select('select * from PlayList where username = ?', [$username]);
    $popular_artists = DB::table('Artists')->leftjoin(
        'Likes', 'Artists.ArtistId', '=', 'Likes.ArtistId'
    )->select(
        'Artists.ArtistId', 'Artists.ArtistTitle'
    )->groupBy(
        'Artists.ArtistId', 'Artists.ArtistTitle'
    )->orderBy(
        DB::raw('count(Likes.username)', 'desc')
    )->limit(
        10
    );

    $user_liked_artists = DB::table('Artists')->join(
        'Likes', 'Artists.ArtistId', '=', 'Likes.ArtistId'
    )->where(
        'Likes.username', '=', $username
    )->select(
        'Artists.ArtistId', 'Artists.ArtistTitle'
    )->union(
        $popular_artists
    )->limit(
        10
    )->get();
       	
	return view(
        'home', 
        [
            'info' => $userinfo, 
            'playList' => $playList,
            'artists' => $user_liked_artists
        ]
    );
    }
}
