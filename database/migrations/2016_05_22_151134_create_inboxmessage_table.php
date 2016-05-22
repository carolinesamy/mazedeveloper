<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInboxmessageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inbox_message', function (Blueprint $table) {
            $table->increments('id');
            $table->string('file_name');

            $table->integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('instructors');

            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::drop('inbox_message');
    }
}
