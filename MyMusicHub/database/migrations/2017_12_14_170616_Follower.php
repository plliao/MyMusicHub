<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Follower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	 Schema::create ( 'Follower', function (Blueprint $table) {
         $table->string ( 'username' )->primary();
         $table->string ( 'follower' );
         $table->timestamps();

	 $table->foreign('username')->references('username')->on('users');
	 $table->foreign('follower')->references('username')->on('users');
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
	Schema::dropIfExists('Follower');
    }
}
