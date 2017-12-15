<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Input;

class SearchResultController extends Controller
{
    //
	public function show()
    {
		$data = Input::all();
		$keyword = '%' . $data['keyword'] . '%';
		$artists = DB::select('select * from Artists where ArtistTitle like ?', [$keyword]);

        return view('SearchResultPage', ['result' => $artists]);
  	}
}
