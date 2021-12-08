<?php

namespace App\Imports;

use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
class FacultyImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Faculty([
            'nameFaculty' => $row["ten_khoa"],
            'available' => 1
        ]);
    }

    public function rules() : array{
        return[
            'ten_khoa' => 'required | unique:Faculty,nameFaculty',

        ];
 
    }

    public function customValidationMessages()
    {
        return[
            'ten_khoa.required' => ':attribute không được để trống',
            'ten_khoa.unique' => ':attribute đã tồn tại',
        ];
    }
}
