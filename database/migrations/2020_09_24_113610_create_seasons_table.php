<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('tmdb_id')->unique();
            $table->unsignedBigInteger('serie_id')->index();
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');
            $table->string('name');
            $table->string('season_number');
            $table->string('slug');
            $table->string('poster_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seasons');
    }
}
