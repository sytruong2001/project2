<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
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
            "email" => "admin@gmail.com",
            "phone" => "0359241554",
            "address" => "Hà Nội",
            "birthday" => "2001-10-08",
            "password" => md5("hacker"),
            "created_at" => new Datetime(),
        ];
        DB::table("admin")->insert($data);
    }
}
