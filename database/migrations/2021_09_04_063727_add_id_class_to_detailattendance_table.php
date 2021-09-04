<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdClassToDetailattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->unsignedInteger('idClass')->after('idStudent');
            $table->foreign('idClass')->references('idClass')->on('classroom');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->dropColumn("idClass");
        });
    }
}
