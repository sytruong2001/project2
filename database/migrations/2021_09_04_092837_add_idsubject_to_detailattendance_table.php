<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdsubjectToDetailattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->integer('idSubject')->unsigned()->nullable()->after("idClass");
            $table->foreign('idSubject')->references('idSubject')->on('subject')->onDelete('SET NULL');
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
            $table->dropForeign(['idSubject']);

            
            $table->dropColumn('idSubject');
        });
    }
}
