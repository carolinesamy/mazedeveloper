<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            $table->string('sfull_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->integer('points')->default('0');
            $table->dateTime('last_hit');
            $table->dateTime('last_hit_msg');


            $table->integer('intake_id')->unsigned();
            $table->foreign('intake_id')->references('id')->on('intakes');

            $table->integer('track_id')->unsigned();
            $table->foreign('track_id')->references('id')->on('tracks');
            $table->rememberToken();
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
        Schema::drop('students');
    }
}
