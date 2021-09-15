<?php

namespace App\Imports;

use App\Models\Assign;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class AssignImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $Class = DB::table("classroom")
        ->where("nameClass", $row["ten_lop"])
        ->first();
        $row["idClass"] = $Class->idClass;
        $Faculty = DB::table("faculty")
        ->where("nameFaculty", $row["ten_khoa"])
        ->first();
        $row["idFaculty"] = $Faculty->idFaculty;
        $Subject = DB::table("subject")
        ->where("nameSubject", $row["ten_mon_hoc"])
        ->first();
        $row["idSubject"] = $Subject->idSubject;
        $Teacher = DB::table("teacher")
        ->where("firstName", "like", "%".$row['ten_giang_vien']."%")
        ->where("middleName", "like", "%".$row['ten_giang_vien']."%")
        ->where("lastName", "like", "%".$row['ten_giang_vien']."%")
        ->first();
        $row["idTeacher"] = $Teacher->idTeacher;
        return new Assign([
            'idClass' => $row["idClass"],
            'idFaculty' => $row["idFaculty"],
            'idSubject' => $row["idSubject"],
            'idTeacher' => $row["idTeacher"],
            'available' => 1
        ]);
    }
}
