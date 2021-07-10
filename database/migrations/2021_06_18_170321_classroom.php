<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Classroom extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classroom', function(Blueprint $table){
            $table->increments('idClass');
            $table->string('nameClass', 150);
            $table->unsignedInteger('idFaculty');
            $table->foreign('idFaculty')->references('idFaculty')->on('faculty');
            $table->unsignedInteger('idMajor');
            $table->foreign('idMajor')->references('idMajor')->on('major');
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
        Schema::dropIfExists('classroom');
    }
}
