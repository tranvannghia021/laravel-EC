<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Staffs;
class StaffsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model =Staffs::class;// kết nối với obj staff mới chạy được
     
    public function definition()
    {
        return [
           'role_id'=>$this->faker->randomElement([1,2,3]),
           'first_name' => $this->faker->firstName,
           'last_name' => $this->faker->lastName,
           'phone' => $this->faker->phoneNumber,
           'email' =>$this->faker->unique()->safeEmail(),
           'password' => bcrypt('123456'),
           'status' => 1,
           'address' => $this->faker->address,
           'start_date' => '2022-04-20',
           'end_date' => '2023-04-20',
           'created_at' => date('Y-m-d H:i:s'),
           'updated_at' => date('Y-m-d H:i:s'),

        ];
}
}
