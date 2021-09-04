<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaidToDetailattendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->increments('idDetail')->after("idStudent");
        });
        //mở t db của detail trong code
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detailattendance', function (Blueprint $table) {
            $table->dropColumn("idDetail");
        });
    }
}
