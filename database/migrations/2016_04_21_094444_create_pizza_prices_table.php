<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePizzaPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('pizza_prices', function (Blueprint $table) {
          $table->increments('id')->unique();
          $table->integer('pizza_id');
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
        Schema::drop('pizza_prices');
    }
}
