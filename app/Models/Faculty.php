<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    public $table = "faculty";

    protected $primaryKey = 'idFaculty';

    protected $fillable = [
        "nameFaculty", "create_at", "update_at", "available"
    ];
}
