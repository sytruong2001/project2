<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SubjectImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Subject([
            'nameSubject' => $row["ten_mon_hoc"],
            'idMajor' => Major::where("nameMajor", $row['ten_nganh'])->value("idMajor"),
            'duration' => $row["thoi_luong_hoc"],
            'available' => 1
        ]);
    }
}
