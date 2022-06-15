<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DiscountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     
     * @return void
     */
    public function run()
    {
        DB::table('discounts')->insert([
            ['id' => 1,'name'=>'Sale 20-4','value'=>10,'status'=>1,'description'=>'sale thôi chứ gì nữa','start_date'=>date('Y-m-d H:i:s'),'end_date'=>date('Y-m-d', mktime(0, 0, 0, date("m"), date("d")+7,   date("Y")))],
            ['id' => 2,'name'=>'Sale 5-5','value'=>20,'status'=>1,'description'=>'sale thôi chứ gì nữa','start_date'=>date('Y-m-d H:i:s'),'end_date'=>date('Y-m-d', mktime(0, 0, 0, date("m")+1, date("d"),   date("Y")))],
        ]); //
    }
  
}
