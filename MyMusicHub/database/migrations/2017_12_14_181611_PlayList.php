<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	Schema::create ( 'PlayList', function (Blueprint $table) { 
	$table->integer ( 'PlayListId' )->primary();
	$table->string ( 'username' );
	$table->string( 'title');
	$table->date ( 'createDate' );
	$table->boolean ( 'public' )->default(1);

	$table->foreign('username')->references('username')->on('users');	
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
	Schema::dropIfExists('PlayList');
    }
}
