<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Teacher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teacher', function(Blueprint $table){
            $table->increments('idTeacher');
            $table->string('firstName', 150);
            $table->string('middleName', 150);
            $table->string('lastName', 150);
            $table->boolean('gender');
            $table->string('email', 255);
            $table->char('phone', 10);
            $table->string('address', 255);
            $table->date('birthday');
            $table->string('password', 100);
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
        Schema::dropIfExists('teacher');
    }
}