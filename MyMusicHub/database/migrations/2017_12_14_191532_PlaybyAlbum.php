<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaybyAlbum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'PlaybyAlbum', function (Blueprint $table) { 
	$table->string ( 'username',45 );
	$table->string ( 'TrackID',22 );
	$table->datetime( 'playtime');
	$table->string ( 'AlbumId',22 );

	$table->primary(array('username', 'TrackId', 'playtime'));
	$table->foreign('username')->references('username')->on('users');
	$table->foreign('TrackId')->references('TrackId')->on('Tracks');
	$table->foreign('AlbumId')->references('AlbumId')->on('Albums');
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
	Schema::dropIfExists('PlaybyAlbum');
    }
}
