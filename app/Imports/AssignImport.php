<?php

namespace App\Imports;

use App\Models\Assign;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssignImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Assign([
            'idClass' => Classroom::where("nameClass", $row['ten_lop'])->value("idClass"),
            'idFaculty' => Faculty::where("nameFaculty", $row['ten_khoa'])->value("idFaculty"),
            'idSubject' => Subject::where("nameSubject", $row['ten_mon_hoc'])->value("idSubject"),
            'idTeacher' => Teacher::where("firstName", "like", $row['ten_giang_vien'])->where("middleName", "like", $row['ten_giang_vien'])->where("lastName", "like", $row['ten_giang_vien'])->value("idTeacher"),
            'available' => 1
        ]);
    }
}
