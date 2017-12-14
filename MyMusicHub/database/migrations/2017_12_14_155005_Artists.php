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
	 Schema::create ( 'Artists', function ($table) {
         $table->string ( 'ArtistId' );
         $table->string ( 'ArtistTitle' );
         $table->date ( 'ArtistDescription' );
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
    }
}
