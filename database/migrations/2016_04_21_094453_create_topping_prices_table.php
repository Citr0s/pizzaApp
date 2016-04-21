<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateToppingPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('topping_prices', function (Blueprint $table) {
          $table->increments('id')->unique();
          $table->integer('topping_id');
          $table->integer('size_id');
          $table->integer('price');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('topping_prices');
    }
}
