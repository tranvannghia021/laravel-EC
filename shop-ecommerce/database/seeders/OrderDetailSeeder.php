<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('order_details')->insert([
            ['order_id' => 1,'product_id'=>1,'amount'=>1,'price'=>120,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['order_id' => 1,'product_id'=>3,'amount'=>2,'price'=>500,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['order_id' => 3,'product_id'=>2,'amount'=>3,'price'=>100,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['order_id' => 4,'product_id'=>4,'amount'=>4,'price'=>1000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['order_id' => 5,'product_id'=>1,'amount'=>5,'price'=>1200,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
    
       ]);
    }
}
