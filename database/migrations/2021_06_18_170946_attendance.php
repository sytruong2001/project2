<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Attendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance', function(Blueprint $table){
            $table->increments('idAttendance');
            $table->date('dateAttendance');
            $table->unsignedInteger('idClass');
            $table->foreign('idClass')->references('idClass')->on('classroom');
            $table->unsignedInteger('idSubject');
            $table->foreign('idSubject')->references('idSubject')->on('subject');
            $table->time('start');
            $table->time('end');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}
