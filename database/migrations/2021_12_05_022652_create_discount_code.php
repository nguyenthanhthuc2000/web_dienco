<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiscountCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_code', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //tên
            $table->string('code'); //mã
            $table->string('number'); // số giảm
            $table->integer('type'); //1 giam theo %, 2 giảm theo số tiền / tổng hóa đơn
            $table->integer('total')->default(0); // còn lại
            $table->integer('used')->default(0); // Đã dùng
//            $table->date('date_end'); // ngày bắt đầu
//            $table->date('date_start');// ngày hết hạn
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('discount_code');
    }
}
