<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $table = "attendance";
    protected $primaryKey = 'idAttendance';
}
