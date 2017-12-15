<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get ( '/', function () {
	return view ( 'welcome' );
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/TracksPage', 'ArtistController@show');
Route::get('/PlayerPage', 'PlayerController@play')->name('PlayerPage');
Route::post('/result','SearchResultController@show');
Route::get('/result', function () {
    return view('welcome');
});
Route::get('/TracksPage', 'ArtistController@show');
Route::get('/playList', 'PlayListController@create');
Route::get('/playListShow', 'PlayListController@show');
Route::get('/UserPage', 'UserPageController@show');
Route::post('/playList', 'PlayListController@store')->name('playList');
Route::post('/PlayerPage', 'PlayerController@store');
Route::post('/TrackRate', 'PlayerController@rate');
