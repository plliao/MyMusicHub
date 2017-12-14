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
       	
	return view('home', ['info'=> $userinfo]);
    }
}
