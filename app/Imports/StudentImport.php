<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

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
        return new Student([
            'lastName' => $row["ho"],
            'middleName' => $row["ten_dem"],
            'firstName' => $row["ten"],
            'gender' => $row["gioi_tinh"] == "Nam" ? 1 : 0,
            'email' => $row["email"],
            'phone' => $row["so_dien_thoai"],
            'address' => $row["dia_chi"],
            'birthday' => date('Y-m-d', strtotime($date)),
            'idClass' => Classroom::where("nameClass", "like", $row['ten_lop'])->value("idClass"),
            'available' => 1
        ]);
    }
}
