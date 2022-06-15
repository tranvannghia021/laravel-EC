<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_id')->nullable();
            $table->integer('order_id')->nullable();
            $table->float('money',14,2)->nullable()->comment('số tiền ');
            $table->string('transaction_code')->nullable();
            $table->string('note')->nullable()->comment('nội dung thanh toán ');
            $table->string('vnp_respond_code')->nullable()->comment('mã phản hồi ');
            $table->string('vnpay_code')->nullable()->comment('mã giao dịch VNPAY ');
            $table->string('bank_code')->nullable()->comment('mã giao dịch ngân hàng ');
            $table->dateTime('time')->nullable()->comment('Thời Gian Giao Dịch ');
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
        Schema::dropIfExists('payments');
    }
}
