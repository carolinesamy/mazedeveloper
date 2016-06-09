<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');

            $table->text('content');
            $table->dateTime('time');

            $table->integer('answer_id')->unsigned();
            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');

            $table->integer('student_id')->unsigned()->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->integer('instructor_id')->unsigned()->nullable();
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');
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
        Schema::drop('replies');
    }
}
