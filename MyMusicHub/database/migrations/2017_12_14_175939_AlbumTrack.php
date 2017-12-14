<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlbumTrack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('AlbumTrack', function (Blueprint $table) {
            $table->string('AlbumId');
            $table->string('TrackId');
            $table->integer('AlbumOrder')->unique();
		
	    $table->primary(array('AlbumId', 'TrackId', 'AlbumOrder'));
	    $table->foreign('AlbumId')->references('AlbumId')->on('Albums');
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
	 Schema::dropIfExists('AlbumTrack');
    }
}
