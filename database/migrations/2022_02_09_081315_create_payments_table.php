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
            $table->bigIncrements('id');
            $table->string('order_id');
            $table->string('thanh_vien');
            $table->integer('money'); // so tien thanh toan
            $table->string('note'); //ghi chu thanh  toans
            $table->string('vnp_response_code'); // ma phan hoi
            $table->string('code_vnp'); // ma giao dich thanh toan
            $table->string('code_bank');// ma giao dich ngan hang
            $table->dateTime('p_time'); // thoi gian chuyen khoang
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
