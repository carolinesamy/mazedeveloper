<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrancestracksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_branchs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('branch_id')->unsigned();
            $table->foreign('branch_id')->references('id')->on('branchs');

            $table->integer('track_id')->unsigned();
            $table->foreign('track_id')->references('id')->on('tracks');

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
        Schema::drop('track_branchs');
    }
}
