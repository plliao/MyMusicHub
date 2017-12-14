<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayListTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'PlayListTrack', function (Blueprint $table) { 
	$table->integer ( 'PlayListId' );
	$table->string ( 'TrackID',22 );
	$table->integer ( 'PlayListOrder' );

	$table->primary(array('PlayListId', 'TrackId', 'PlayListOrder'));
	$table->foreign('PlayListId')->references('PlayListId')->on('PlayList');
	$table->foreign('TrackId')->references('TrackId')->on('Tracks');
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
	Schema::dropIfExists('PlayListTrack');
    }
}
