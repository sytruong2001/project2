<?php

use Illuminate\Database\Seeder;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "nameMajor" => "Lập trình viên quốc tế",
            "created_at" => new Datetime(),
        ];
        DB::table("major")->insert($data);
    }
}
