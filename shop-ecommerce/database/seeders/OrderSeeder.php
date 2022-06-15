<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('orders')->insert([
            ['id' => 1,'customer_id'=>1,'staff_id'=>1,'discount_id'=>2,'status'=>1,'discount_value'=>10,'total_price'=>12000,'payment_method_id'=>1,'address'=>'HCM','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 2,'customer_id'=>3,'staff_id'=>2,'discount_id'=>2,'status'=>2,'discount_value'=>10,'total_price'=>12000,'payment_method_id'=>1,'address'=>'HCM','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 3,'customer_id'=>2,'staff_id'=>3,'discount_id'=>2,'status'=>3,'discount_value'=>10,'total_price'=>12000,'payment_method_id'=>1,'address'=>'HCM','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 4,'customer_id'=>4,'staff_id'=>4,'discount_id'=>2,'status'=>4,'discount_value'=>10,'total_price'=>12000,'payment_method_id'=>1,'address'=>'HCM','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 5,'customer_id'=>1,'staff_id'=>5,'discount_id'=>2,'status'=>5,'discount_value'=>10,'total_price'=>12000,'payment_method_id'=>1,'address'=>'HCM','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
    
       ]);
    }
}
