<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            "firstName" => "Sỹ",
            "middleName" => "Văn",
            "lastName" => "Trương",
            "gender" => 0,
            "email" => "vanyyy2001@gmail.com",
            "phone" => "0359241554",
            "address" => "Hà Nội",
            "birthday" => "2001-10-08",
            "idClass" => 1,
            "created_at" => new Datetime(),
        ];
        DB::table("student")->insert($data);
    }
}
