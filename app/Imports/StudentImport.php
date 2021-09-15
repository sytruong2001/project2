<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class StudentImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = str_replace('/', '-', $row["ngay_sinh"]);
        $Faculty = DB::table("faculty")
        ->where("nameFaculty", "like", "%".$row['ten_khoa']."%")
        ->first();
        $idFaculty = $Faculty->idFaculty;
        // dd($idFaculty);
        $Class = DB::table("classroom")
        ->where("nameClass", "like", "%".$row['ten_lop']."%")
        ->where("idFaculty", "=", $idFaculty)
        ->first();
        // dd($Class);
        $row["idClass"] = $Class->idClass;
        return new Student([
            'lastName' => $row["ho"],
            'middleName' => $row["ten_dem"],
            'firstName' => $row["ten"],
            'gender' => $row["gioi_tinh"] == "Nam" ? 0 : 1,
            'email' => $row["email"],
            'phone' => $row["so_dien_thoai"],
            'address' => $row["dia_chi"],
            'birthday' => date('Y-m-d', strtotime($date)),
            'idClass' => $row["idClass"],
            'available' => 1
        ]);
    }
}
