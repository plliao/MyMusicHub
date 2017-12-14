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
	$table->string ( 'ArtistId',22 );
	$table->integer( 'TrackDuration');

	$table->foreign('ArtistId')->references('ArtistId')->on('Artists');
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
