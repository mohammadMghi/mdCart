<?php


use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingcartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('md_cart', function (Blueprint $table) {
            $table->string('cart_id');
            $table->string('price');
            $table->string('product_name');
            $table->string('qty');
            $table->nullableTimestamps();

            $table->primary(['cart_id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('md_cart');
    }
}