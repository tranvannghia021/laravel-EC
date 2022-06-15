<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ImportDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('import_details')->insert([
            ['import_id'=>1,'product_id' => 1,'category_id' => 1,'provider_id'=>1,'amount'=>10,'price'=>300000],
            ['import_id'=>2,'product_id' => 5,'category_id' => 2,'provider_id'=>2,'amount'=>10,'price'=>300000],
            ['import_id'=>2,'product_id' => 1,'category_id' => 1,'provider_id'=>2,'amount'=>5,'price'=>300000],
            ['import_id'=>2,'product_id' => 2,'category_id' => 1,'provider_id'=>1,'amount'=>2,'price'=>450000],
            ['import_id'=>2,'product_id' => 3,'category_id' => 1,'provider_id'=>3,'amount'=>2,'price'=>390000],
        ]);
    }
}
