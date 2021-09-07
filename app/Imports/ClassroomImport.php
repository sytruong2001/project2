<?php

namespace App\Imports;

use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClassroomImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Classroom([
            'nameClass' => $row["ten_lop"],
            'idFaculty' => Faculty::where("nameFaculty", $row['ten_khoa'])->value("idFaculty"),
            'idMajor' => Major::where("nameMajor", $row['ten_nganh'])->value("idMajor"),
            'available' => 1
        ]);
    }
}
