<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        Schema::rename('group_product', 'group_products');
        Schema::rename('image_product', 'image_products');
        Schema::rename('product_detail;', 'product_details');
        Schema::rename('staff;', 'staffs');
        */
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->integer('role_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('status')->unsigned();
            $table->longText('address');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('staffs');
    }
}
