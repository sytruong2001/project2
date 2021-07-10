<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "nameClass" => "BKD02",
            "idFaculty" => 1,
            "idMajor" => 1,
            "created_at" => new Datetime(),
        ];
        DB::table("classroom")->insert($data);
    }
}
