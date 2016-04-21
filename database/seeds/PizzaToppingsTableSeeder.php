<?php

use Illuminate\Database\Seeder;

class PizzaToppingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizza_toppings')->insert(['pizza_id' => '1', 'topping_id' => '1']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '1', 'topping_id' => '2']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '1']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '2']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '3']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '4']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '5']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '6']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '7']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '2', 'topping_id' => '8']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '1']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '2']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '9']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '10']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '11']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '3', 'topping_id' => '12']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '1']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '2']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '5']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '9']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '10']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '4', 'topping_id' => '13']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '5', 'topping_id' => '1']);
        DB::table('pizza_toppings')->insert(['pizza_id' => '5', 'topping_id' => '2']);
    }
}
