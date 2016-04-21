<?php

use Illuminate\Database\Seeder;

class PizzasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pizzas')->insert(['name' => 'Original Pizza']);
        DB::table('pizzas')->insert(['name' => 'Gimme the Meat']);
        DB::table('pizzas')->insert(['name' => 'Veggie Delight']);
        DB::table('pizzas')->insert(['name' => 'Make Mine Hot']);
        DB::table('pizzas')->insert(['name' => 'Create Your Own']);
    }
}
