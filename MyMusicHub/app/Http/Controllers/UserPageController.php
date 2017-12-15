<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
		$userId = $request->input('userId');
		$userName = $request->input('userName');
		
		$playList_public = DB::table('PlayList')
				 ->where('username', '=', $userName)
				 ->where('public', '=', '1')
				 ->get(); 
		
		return view('UserPage',
				['userId' => $userId,
				 'userName' => $userName,
				 'playList' => $playList_public,
				]);
	}
    
}
