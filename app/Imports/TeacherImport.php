<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class TeacherImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $date = str_replace('/', '-', $row["ngay_sinh"]);
        return new Teacher([
            'lastName' => $row["ho"],
            'middleName' => $row["ten_dem"],
            'firstName' => $row["ten"],
            'gender' => $row["gioi_tinh"] == "Nam" ? 0 : 1,
            'email' => $row["email"],
            'phone' => $row["so_dien_thoai"],
            'address' => $row["dia_chi"],
            'birthday' => date('Y-m-d', strtotime($date)),
            'password' => md5($row["mat_khau"]),
            'available' => 1
        ]);
    }
}
