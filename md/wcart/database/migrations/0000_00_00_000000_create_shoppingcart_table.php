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
        Schema::create(config('cart.db.table'), function (Blueprint $table) {
            $table->string('id');
            $table->string('price');
            $table->string('product_name');
            $table->string('qty');
            $table->nullableTimestamps();

            $table->primary(['id']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop(config('cart.db.table'));
    }
}