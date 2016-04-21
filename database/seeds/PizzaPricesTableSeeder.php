<?php

use Illuminate\Database\Seeder;

class PizzaPricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('pizza_prices')->insert([
          'pizza_id' => '1',
          'size_id' => '1',
          'price' => '800',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '1',
          'size_id' => '2',
          'price' => '900',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '1',
          'size_id' => '3',
          'price' => '1100',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '2',
          'size_id' => '1',
          'price' => '1100',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '2',
          'size_id' => '2',
          'price' => '1450',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '2',
          'size_id' => '3',
          'price' => '1650',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '3',
          'size_id' => '1',
          'price' => '1000',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '3',
          'size_id' => '2',
          'price' => '1300',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '3',
          'size_id' => '3',
          'price' => '1500',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '4',
          'size_id' => '1',
          'price' => '1100',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '4',
          'size_id' => '2',
          'price' => '1300',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '4',
          'size_id' => '3',
          'price' => '1500',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '5',
          'size_id' => '1',
          'price' => '800',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '5',
          'size_id' => '2',
          'price' => '900',
      ]);
      DB::table('pizza_prices')->insert([
          'pizza_id' => '5',
          'size_id' => '3',
          'price' => '1100',
      ]);
    }
}
