<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_details')->insert([
            ['id' => 1,'product_id'=>1,'code_color'=>'#ffe00','amount'=>20,'price'=>350000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 2,'product_id'=>2,'code_color'=>'#ffe00','amount'=>30,'price'=>550000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 3,'product_id'=>3,'code_color'=>'#ffe00','amount'=>20,'price'=>450000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 4,'product_id'=>4,'code_color'=>'#efe00','amount'=>10,'price'=>150000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 5,'product_id'=>5,'code_color'=>'#sae00','amount'=>20,'price'=>350000,'created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
      
        ]);
    }
}
