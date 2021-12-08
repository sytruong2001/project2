<?php

namespace App\Imports;

use App\Models\Classroom;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use DB;

class ClassroomImport implements ToModel, WithHeadingRow, WithValidation
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

    public function rules() : array{
        return[
            'ten_lop' => 'required | unique:Classroom,nameClass',
            'ten_khoa' => 'required | unique:Classroom,idFaculty',
            'ten_nganh' => 'required',

        ];
 
    }

    public function customValidationMessages()
    {
        return[
            'ten_lop.required' => ':attribute không được để trống',
            'ten_lop.unique' => ':attribute đã tồn tại',
            'ten_khoa.required' => ':attribute không được để trống',
            'ten_khoa.unique' => ':attribute đã tồn tại',
            'ten_nganh.required' => ':attribute không được để trống',
        ];
    }
}
