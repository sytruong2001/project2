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

    // public function getGenderNameAttribute()
    // {
    //     if($this->gender == 0){
    //         return "Nữ";
    //     }else{
    //         return "Nam";
    //     }
    // }
}
