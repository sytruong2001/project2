<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdSubjectToDetailattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->unsignedInteger('idSubject')->after('idClass');
            $table->foreign('idSubject')->references('idSubject')->on('subject');
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
            $table->dropColumn("idSubject");
        });
    }
}
