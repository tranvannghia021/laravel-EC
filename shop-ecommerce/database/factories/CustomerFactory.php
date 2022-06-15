<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
class CustomerFactory extends Factory
{
    protected $model =Customer::class;// kết nối với obj staff mới chạy được
     
    public function definition()
    {
        return [
           'first_name' => $this->faker->firstName,
           'last_name' => $this->faker->lastName,
           'gender' => $this->faker->randomElement(['Nam','Nữ','Khác']),
           'phone' => $this->faker->phoneNumber,
           'email' =>$this->faker->unique()->safeEmail(),
           'password' => bcrypt('123456'),
           'status' => 1,
           'address' => $this->faker->address,
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
    }
}