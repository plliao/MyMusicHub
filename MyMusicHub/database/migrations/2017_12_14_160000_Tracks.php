<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tracks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'Tracks', function (Blueprint $table) { 
	$table->string ( 'TrackId',22 )->primary();
	$table->string ( 'TrackName',200 );
	$table->integer( 'TrackDuration');
	$table->string ( 'TrackArtist', 22 );
	$table->string ( 'AlbumId' );

	$table->foreign('TrackArtist')->references('ArtistId')->on('Artists');	
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
	Schema::dropIfExists('Tracks');
    }
}
