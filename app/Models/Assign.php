<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assign extends Model
{
    public $table = "assign";
    protected $primaryKey = 'idAssign';
    protected $fillable = [
        "idClass","idFaculty","idSubject","idTeacher","start_date","create_at", "update_at", "available"
    ];
}
