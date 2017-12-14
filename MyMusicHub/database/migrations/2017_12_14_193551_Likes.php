<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Likes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'Likes', function (Blueprint $table) { 
	$table->string ( 'username' );
	$table->string ( 'ArtistID' );
	$table->timestamps();

	$table->primary(array('username', 'ArtistId'));
	$table->foreign('username')->references('username')->on('users');
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
	 Schema::dropIfExists('Likes');
    }
}
