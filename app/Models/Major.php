<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    public $table = "major";
    protected $primaryKey = 'idMajor';

    protected $fillable = [
        "nameMajor", "create_at", "update_at", "available"
    ];
}
