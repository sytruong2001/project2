<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teacher extends Model
{
    public $table = "teacher";

    protected $primaryKey = 'idTeacher';

    protected $fillable = [
        "firstName", "middleName", "lastName", "gender", "email", "phone", "address", "birthday", "password", "create_at", "update_at", "available"
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
