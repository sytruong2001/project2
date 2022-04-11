<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;

class SubjectImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $Major = DB::table("major")
            ->where("nameMajor", $row["ten_nganh"])
            ->first();
        $row["idMajor"] = $Major->idMajor;
        return new Subject([
            'nameSubject' => $row["ten_mon_hoc"],
            'idMajor' => $row["idMajor"],
            'duration' => $row["thoi_luong_hoc"],
            'available' => 1
        ]);
    }

    public function rules(): array
    {
        return [
            'ten_mon_hoc' => 'required | unique:Subject,nameSubject',
            'ten_nganh' => 'required',
            'thoi_luong_hoc' => 'required',

        ];
    }

    public function customValidationMessages()
    {
        return [
            'ten_mon_hoc.required' => ':attribute không được để trống',
            'ten_mon_hoc.unique' => ':attribute đã tồn tại',
            'ten_nganh.required' => ':attribute không được để trống',
            'thoi_luong_hoc.required' => ':attribute không được để trống',
        ];
    }
}