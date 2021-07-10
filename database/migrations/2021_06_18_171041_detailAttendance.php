<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DetailAttendance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailAttendance', function(Blueprint $table){
            $table->unsignedInteger('idStudent');
            $table->foreign('idStudent')->references('idStudent')->on('student');
            $table->unsignedInteger('idAttendance');
            $table->foreign('idAttendance')->references('idAttendance')->on('attendance');
            $table->boolean('status');
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
        Schema::dropIfExists('detailAttendance');
    }
}
