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
	Schema::create ( 'Tracks', function ($table) { 
	$table->string ( 'TrackId' );
	$table->string ( 'TrackName' );
	$table->integer( 'TrackDuration');
	$table->string ( 'TrackArtist' );
	$table->string ( 'AlbumId' );
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
    }
}
