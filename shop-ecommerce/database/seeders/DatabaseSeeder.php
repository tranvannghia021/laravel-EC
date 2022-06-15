<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\StaffSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       $this->call(StaffSeeder::class);
       $this->call(GroupProductSeeder::class);
       $this->call(ImageProductSeeder::class);
       $this->call(ImagesSeeder::class);
      $this->call(ProductSeeder::class);
       $this->call(ProductDetailSeeder::class);
      
      //  \App\Models\Staffs::factory(10)->create();
        \App\Models\Customer::factory(10)->create();
        $this->call(ProviderSeeder::class);
        $this->call(ImportSeeder::class);
        $this->call(ImportDetailSeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderDetailSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(RatingSeeder::class);
        $this->call(DiscountSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(PaymentMethodSeeder::class);
        $this->call(StaffSeeder::class);
    }
}
