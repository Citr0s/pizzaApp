<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PizzasTableSeeder::class);
        $this->call(ToppingsTableSeeder::class);
        $this->call(SizesTableSeeder::class);
        $this->call(PizzaPricesTableSeeder::class);
        $this->call(ToppingPricesTableSeeder::class);
        $this->call(PizzaToppingsTableSeeder::class);
    }
}
