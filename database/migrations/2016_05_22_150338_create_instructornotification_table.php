<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstructornotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instructor_notifications', function (Blueprint $table) {
            $table->increments('id');



            $table->integer('instructor_id')->unsigned();
            $table->foreign('instructor_id')->references('id')->on('instructors')->onDelete('cascade');

            $table->integer('notification_id')->unsigned();
            $table->foreign('notification_id')->references('id')->on('notifications')->onDelete('cascade');
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
        Schema::drop('instructor_notifications');
    }
}
