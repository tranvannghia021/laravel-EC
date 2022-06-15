<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
           
            ['id' => 1,'name'=>'Quản Lý Sản Phẩm','map'=>'/admin/products/','active'=>1],
            ['id' => 2,'name'=>'Quản Lý Nhà Cung Cấp','map'=>'/admin/providers/','active'=>1],
            ['id' => 3,'name'=>'Quản Lý Nhập Hàng','map'=>'/admin/imports/','active'=>1],
            ['id' => 4,'name'=>'Quản Lý Danh Mục Sản Phẩm','map'=>'/admin/group-products/','active'=>1],
            ['id' => 5,'name'=>'Quản Lý Đơn Hàng','map'=>'/admin/orders/','active'=>1],
            ['id' => 6,'name'=>'Quản Lý Đánh Giá','map'=>'/admin/ratings/','active'=>1],
            ['id' => 7,'name'=>'Quản Lý Nhân Viên','map'=>'/admin/staffs/','active'=>1],
            ['id' => 8,'name'=>'Quản Lý Khách Hàng','map'=>'/admin/customers/','active'=>1],
            ['id' => 9,'name'=>'Quản Lý Khuyến Mãi','map'=>'/admin/discounts/','active'=>1],
            ['id' => 10,'name'=>'Quản Lý Giao Diện Banner','map'=>'/admin/sliders/','active'=>1],
            ['id' => 11,'name'=>'Quản Lý Phân Quyền','map'=>'/admin/roles/','active'=>1],
        ]);
    }
}
