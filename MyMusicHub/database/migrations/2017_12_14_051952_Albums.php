<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Albums extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	 Schema::create ( 'Albums', function (Blueprint $table) {
         $table->string ( 'AlbumId' )->primary();
         $table->string ( 'AlbumName' );
         $table->date ( 'AlbumReleaseDate' );
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
	Schema::dropIfExists('Albums');
    }
}
