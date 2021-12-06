<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_code');
            $table->string('email');
            $table->string('phone');
            $table->string('name');
            $table->string('address');
            $table->integer('total_money')->default(0);
            $table->integer('status')->default(0); //0 chờ xử lí, 1: đang xử lí, 2: thành công, 3: hủy
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
        Schema::dropIfExists('order');
    }
}
