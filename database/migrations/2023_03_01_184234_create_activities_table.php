<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->integer('position');
            $table->integer('difficulty');
            $table->integer('time');
            $table->string('solution');
            $table->unsignedBigInteger('itinerary_id');
            $table->foreign('itinerary_id')->references('id')->on('itineraries');
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
        Schema::dropIfExists('activities');
    }
}
