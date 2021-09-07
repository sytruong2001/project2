<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class classroom extends Model
{
    public $table = "classroom";
    protected $primaryKey = 'idClass';
    protected $fillable = [
        "nameClass","idFaculty","idMajor","create_at", "update_at", "available"
    ];

}
