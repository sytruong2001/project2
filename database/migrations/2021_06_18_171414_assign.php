<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Assign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assign', function(Blueprint $table){
            $table->increments('idAssign');
            $table->unsignedInteger('idClass');
            $table->foreign('idClass')->references('idClass')->on('classroom');
            $table->unsignedInteger('idFaculty');
            $table->foreign('idFaculty')->references('idFaculty')->on('faculty');
            $table->unsignedInteger('idSubject');
            $table->foreign('idSubject')->references('idSubject')->on('subject');
            $table->unsignedInteger('idTeacher');
            $table->foreign('idTeacher')->references('idTeacher')->on('teacher');
            $table->date('start_date');
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
        Schema::dropIfExists('assign');
    }
}