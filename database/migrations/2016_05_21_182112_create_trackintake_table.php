<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrackintakeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_intakes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('intake_id')->unsigned();
            $table->foreign('intake_id')->references('id')->on('intakes')->onDelete('cascade');

            $table->integer('track_id')->unsigned();
            $table->foreign('track_id')->references('id')->on('tracks')->onDelete('cascade');

            $table->boolean('state')->default('1');

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
        Schema::drop('track_intakes');
    }
}
