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
    
    $popular_users = DB::table('users')->leftjoin(
        'Follower', 'users.username', '=', 'Follower.username'
    )->select(
        'users.username'
    )->where(
        'users.username', '<>', $username
    )->groupBy(
        'users.username'
    )->orderBy(
        DB::raw('count(follower)', 'desc')
    )->limit(
        10
    );
    $user_followed_users = DB::table(
        'Follower'
    )->select(
        'username'
    )->where(
        'follower', '=', $username
    )->union(
        $popular_users
    )->limit(
        10
    )->get();

    $PlaybyPlayList = DB::table('PlaybyPlayList'
    )->join('PlayList', 'PlaybyPlayList.PlayListId', '=', 'PlayList.PlayListId'
    )->select(
        DB::raw('count(playtime) as playtimes'), 'title'
    )->where( 'public', '=', 1
    )->groupBy( 'PlayList.PlayListId', 'title'
    )->orderBy(
	'playtimes' , 'desc'
    )->limit(
	10
    )->get();
	

    $PlaybyAlbum = DB::table('PlaybyAlbum')->join(
	'Albums', 'PlaybyAlbum.AlbumID', '=', 'Albums.AlbumID'
    )->select(
	DB::raw('count(playtime) as playtimes'), 'AlbumName'
    )->groupBy( 'Albums.AlbumId', 'AlbumName'
    )->orderBy(
	'playtimes', 'desc'
    )->limit(
	10
    )->get();

	return view(
        'home', 
        [
            'info' => $userinfo, 
            'playList' => $playList,
            'artists' => $user_liked_artists,
	    'all_other_users' => $user_followed_users,
	    'PlaybyPlayList' => $PlaybyPlayList,
	    'PlaybyAlbum' => $PlaybyAlbum
        ]
    );
    }
}
