<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    public $table = "student";
    protected $primaryKey = 'idStudent';
    protected $fillable = [
        "firstName","middleName","lastName","gender","email","phone","address","birthday","idClass", "create_at", "update_at", "available"
    ];
}
