<?php

namespace App\Imports;

use App\Models\Major;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MajorImport implements ToModel, WithHeadingRow
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
}
