<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('ifull_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->nullable();
            $table->dateTime('last_hit');
            $table->dateTime('last_hit_msg');

            $table->integer('points')->default('0');

            $table->enum('type', ['internal', 'external','consultant']);

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
        Schema::drop('instructors');
    }
}
