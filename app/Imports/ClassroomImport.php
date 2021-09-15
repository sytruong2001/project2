<?php

namespace App\Imports;

use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;

class ClassroomImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $Faculty = DB::table("faculty")
        ->where("nameFaculty", $row["ten_khoa"])
        ->first();
        $row["idFaculty"] = $Faculty->idFaculty;
        $Major = DB::table("major")
        ->where("nameMajor", $row["ten_nganh"])
        ->first();
        $row["idMajor"] = $Major->idMajor;
        return new Classroom([
            'nameClass' => $row["ten_lop"],
            'idFaculty' => $row["idFaculty"],
            'idMajor' => $row["idMajor"],
            'available' => 1
        ]);
    }
}
