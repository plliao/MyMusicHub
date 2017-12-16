<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;

class UserPageController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}
	
	public function show(Request $request)
	{
		$username = $request->input('userName');
        $userinfo = DB::select(
            'select username, city from users where username = ?', 
            [$username]
        )[0];
		$playList_public = DB::table('PlayList')
				 ->where('username', '=', $username)
				 ->where('public', '=', '1')
				 ->get(); 

		$follow = DB::table(
            'Follower'
        )->where(
            'username', '=', $username
        )->where(
            'follower', '=', Auth::user()->username
        )->first();

		return view('UserPage',
				[
                 'userinfo' => $userinfo, 
				 'playList' => $playList_public,
                 'follower' => $follow
				]);
	}
    
    public function follow(Request $request)
    {
		$data = Input::all();
		
        $follow = DB::table(
            'Follower'
        )->where(
            'username', '=', $data['username']
        )->where(
            'follower', '=', Auth::user()->username
        )->first();

        if ($data['follow']==1 and !$follow) 
        {
            DB::table(
                'Follower'
            )->insert(
                [
                    'username' => $data['username'],
                    'follower' => Auth::user()->username,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            );
            session(['status' => 'You follow '. $data['username'] . '!!']);
        }
        else if ($data['follow']==0 and $follow)
        {
            DB::table(
                'Follower'
            )->where(
                'Follower.username', '=', $data['username']
            )->where(
                'Follower.follower', '=', Auth::user()->username
            )->delete();
            session(['status' => 'You unfollow '. $data['username'] . '!!']);
        }

        return redirect()->route(
            'UserPage', 
            [ 
                'userName' => $data['username'],
            ]
        );
    }
}
