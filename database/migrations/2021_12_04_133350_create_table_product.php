<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category')->nullable(); // danh muc sp
            $table->integer('remains')->default(0); //sl con lai
            $table->integer('quantity')->default(0); //sl da ban
            $table->string('origin')->nullable(); //noi sx
            $table->string('description')->nullable(); //mo ta
            $table->string('image')->nullable(); //mo ta
            $table->integer('price')->default(0); //gia
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
        Schema::dropIfExists('product');
    }
}
