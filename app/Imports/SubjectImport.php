<?php

namespace App\Imports;

use App\Models\Subject;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use DB;
class SubjectImport implements ToModel, WithHeadingRow
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
}
