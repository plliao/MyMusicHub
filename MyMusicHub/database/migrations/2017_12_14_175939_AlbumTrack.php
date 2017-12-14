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
            $table->string('AlbumId',22);
            $table->string('TrackId',22);
            $table->integer('AlbumOrder');
		
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
