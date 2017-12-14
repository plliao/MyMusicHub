<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Artists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
	 Schema::create ( 'Artists', function (Blueprint $table) {
         $table->string ( 'ArtistId' )->primary();
         $table->string ( 'ArtistTitle' );
         $table->string ( 'ArtistDescription' );
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
	Schema::dropIfExists('Artists');
    }
}
