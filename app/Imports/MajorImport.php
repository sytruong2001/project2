<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
class MajorImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Major([
            'nameMajor' => $row["ten_nganh"],
            'available' => 1
        ]);
    }

    public function rules() : array{
        return[
            'ten_nganh' => 'required | unique:Major,nameMajor',

        ];
 
    }

    public function customValidationMessages()
    {
        return[
            'ten_nganh.required' => ':attribute không được để trống',
            'ten_nganh.unique' => ':attribute đã tồn tại',
        ];
    }
}
