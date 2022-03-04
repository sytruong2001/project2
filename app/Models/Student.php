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

    public function getGendernameAttribute()
    {
        if($this->gender == 1){
            return "Nữ";
        }else{
            return "Nam";
        }   
    }

    public function getFullnameAttribute()
    {
        return $this->lastName . " " . $this->middleName . " " . $this->firstName;
    }
}
