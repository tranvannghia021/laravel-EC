<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('staffs')->insert([
            ['id' => 1,'role_id' =>1,'first_name' =>'Trung','last_name'=>'Admin','phone'=>'0707624367 ','email'=>'admin@gmail.com','password'=>'$2y$10$CTb4lh58IvxICgzKAfRY5.V9sTv3L86W2CLb6DUMXo1PZR2qH0OAm','status'=>1,'address'=>'SGU An Duong Vuong ','start_date'=>'2022-04-15','end_date'=>'2023-04-15'],
            ['id' => 2,'role_id' =>2,'first_name' =>'Minh','last_name'=>'Trung','phone'=>'0707624367 ','email'=>'minhtrung@gmail.com','password'=>'$2y$10$CTb4lh58IvxICgzKAfRY5.V9sTv3L86W2CLb6DUMXo1PZR2qH0OAm','status'=>1,'address'=>'Binh Chanh, HCM, VN ','start_date'=>'2022-04-22','end_date'=>'2023-01-25'],
        ]);
    }
}
