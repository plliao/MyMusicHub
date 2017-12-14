<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rating extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'Rating', function (Blueprint $table) { 
	$table->string ( 'username', 45 );
	$table->string ( 'TrackID', 22 );
	$table->timestamps();
	$table->integer( 'rating');

	$table->primary(array('username', 'TrackId'));
	$table->foreign('username')->references('username')->on('users');
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
	 Schema::dropIfExists('Rating');
    }
}
