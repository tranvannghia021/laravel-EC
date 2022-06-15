<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class GroupProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_products')->insert([
            ['id' => 1,'name' =>'Ba Lô','thumb'=>'SIMPLE BACKPACK 3.0 SS2 - GRAY.png'],
            ['id' => 2,'name' =>'Túi','thumb'=>'BAMA BUMBAG Black.png'],
            ['id' => 3,'name' =>'Phụ Kiện','thumb'=>'vi_nu_thoi_trang_tien_dung_5c91 (1).jpg'],
           
        ]);
    }
}
