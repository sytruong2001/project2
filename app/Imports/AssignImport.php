<?php

namespace App\Imports;

use App\Models\Assign;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use DB;
class AssignImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules() : array{
        return[
            'ten_lop' => 'required',
            'ten_khoa' => 'required',
            'ten_mon_hoc' => 'required',
            'ten_giang_vien' => 'required',

        ];
 
    }

    public function customValidationMessages()
    {
        return[
            'ten_lop.required' => ':attribute không được để trống',
            'ten_khoa.required' => ':attribute không được để trống',
            'ten_mon_hoc.required' => ':attribute không được để trống',
            'ten_giang_vien.required' => ':attribute không được để trống',
        ];
    }
}
