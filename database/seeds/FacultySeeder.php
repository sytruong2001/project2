<?php

use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "nameFaculty" => "K11",
            "created_at" => new Datetime(),
        ];
        DB::table("faculty")->insert($data);
    }
}
