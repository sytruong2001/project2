<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
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
            ->where("nameFaculty", "like", "%" . $row['ten_khoa'] . "%")
            ->first();
        $idFaculty = $Faculty->idFaculty;
        // dd($idFaculty);
        $Class = DB::table("classroom")
            ->where("nameClass", "like", "%" . $row['ten_lop'] . "%")
            ->first();
        // dd($Class);
        $row["idClass"] = $Class->idClass;
        // dd($row["idClass"]);
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

    public function rules(): array
    {
        return [
            'ho' => 'required',
            'ten_dem' => 'required',
            'ten' => 'required',
            'gioi_tinh' => 'required',
            'email' => 'required | unique:Student,email',
            'so_dien_thoai' => 'required | unique:Student,phone',
            'dia_chi' => 'required',
            'ngay_sinh' => 'required',
            'ten_lop' => 'required',
            'ten_khoa' => 'required',

        ];
    }

    public function customValidationMessages()
    {
        return [
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
            'ten_lop.required' => ':attribute không được để trống',
            'ten_khoa.required' => ':attribute không được để trống',
        ];
    }
}