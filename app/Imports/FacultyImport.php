<?php

namespace App\Imports;

use App\Models\Faculty;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\ToModel;

class FacultyImport implements ToModel, WithHeadingRow
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
}
