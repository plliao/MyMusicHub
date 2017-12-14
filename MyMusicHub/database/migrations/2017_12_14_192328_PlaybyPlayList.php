<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlaybyPlayList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'PlaybyPlayList', function (Blueprint $table) { 
	$table->string ( 'username', 45 );
	$table->string ( 'TrackID',22 );
	$table->datetime( 'playtime');
	$table->integer ( 'PlayListId' );

	$table->primary(array('username', 'TrackId', 'playtime'));
	$table->foreign('username')->references('username')->on('users');
	$table->foreign('TrackId')->references('TrackId')->on('Tracks');
    $table->foreign('PlayListId')->references('PlayListId')->on('PlayList');
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
	Schema::dropIfExists('PlaybyPlayList');
    }
}
