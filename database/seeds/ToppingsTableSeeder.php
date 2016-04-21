<?php

use Illuminate\Database\Seeder;

class ToppingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('toppings')->insert(['name' => 'Cheese']);
        DB::table('toppings')->insert(['name' => 'Tomato Sauce']);
        DB::table('toppings')->insert(['name' => 'Pepperoni']);
        DB::table('toppings')->insert(['name' => 'Ham']);
        DB::table('toppings')->insert(['name' => 'Chicken']);
        DB::table('toppings')->insert(['name' => 'Minced Deef']);
        DB::table('toppings')->insert(['name' => 'Sausage']);
        DB::table('toppings')->insert(['name' => 'Bacon']);
        DB::table('toppings')->insert(['name' => 'Onions']);
		    DB::table('toppings')->insert(['name' => 'Green Peppers']);
        DB::table('toppings')->insert(['name' => 'Mushrooms']);
        DB::table('toppings')->insert(['name' => 'Sweetcorn']);
        DB::table('toppings')->insert(['name' => 'Jalapeno Peppers']);
    }
}
