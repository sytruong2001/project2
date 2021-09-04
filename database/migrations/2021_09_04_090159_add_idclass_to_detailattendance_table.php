<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdclassToDetailattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->integer('idClass')->unsigned()->nullable()->after("idStudent");
            $table->foreign('idClass')->references('idClass')->on('classroom')->onDelete('SET NULL');
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
            $table->dropForeign(['idClass']);

            
            $table->dropColumn('idClass');
        });
    }
}
