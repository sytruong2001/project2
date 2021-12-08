<?php

namespace App\Imports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
class TeacherImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules() : array{
        return[
            'ho' => 'required',
            'ten_dem' => 'required',
            'ten' => 'required',
            'gioi_tinh' => 'required',
            'email' => 'required | unique:Teacher,email',
            'so_dien_thoai' => 'required | unique:Teacher,phone',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required',
            'mat_khau' => 'required',

        ];
 
    }

    public function customValidationMessages()
    {
        return[
            'ho.required' => ':attribute không được để trống',
            'ten_dem.required' => ':attribute không được để trống',
            'ten.required' => ':attribute không được để trống',
            'gioi_tinh.required' => ':attribute không được để trống',
            'email.required' => ':attribute không được để trống',
            'email.unique' => ':attribute đã tồn tại',
            'so_dien_thoai.required' => ':attribute không được để trống',
            'so_dien_thoai.unique' => ':attribute đã tồn tại',
            'dia_chi.required' => ':attribute không được để trống',
            'ngay_sinh.required' => ':attribute không được để trống',
            'mat_khau.required' => ':attribute không được để trống',
        ];
    }
}
