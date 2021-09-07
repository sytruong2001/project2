<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $table = "subject";
    protected $primaryKey = 'idSubject';
    protected $fillable = [
        "nameSubject","idMajor","duration", "create_at", "update_at", "available"
    ];
}
