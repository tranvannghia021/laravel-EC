<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ratings')->insert([
            ['id' => 1,'customer_id'=>2,'product_id'=>1,'point'=>5,'context'=>'Sản phẩm chất lượng','image'=>'/storage/image/ratings/','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 2,'customer_id'=>4,'product_id'=>3,'point'=>4,'context'=>'Sản phẩm chất lượng, bị dơ một tý','image'=>'/storage/image/ratings/','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 3,'customer_id'=>5,'product_id'=>5,'point'=>5,'context'=>'Sản phẩm chất lượng','image'=>'/storage/image/ratings/','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
        ]);
    }
}
