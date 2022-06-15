<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('providers')->insert([
            ['id' => 1,'name'=>'BAMA','address'=>'Trần Hưng Đạo,Q1,TP HCM','phones'=>'028654367','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 2,'name'=>'VSDG','address'=>'Q8,TP HCM','phones'=>'028475317','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 3,'name'=>'THEMAY','address'=>'An Sương,Bình Tân,TP HCM','phones'=>'028784457','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
            ['id' => 4,'name'=>'DONGAN','address'=>'Bình Dương','phones'=>'028645389','created_at'=> date('Y-m-d H:i:s'),'updated_at'=> date('Y-m-d H:i:s')],
        ]);
    }
}
