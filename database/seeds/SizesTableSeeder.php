<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('sizes')->insert(['name' => 'small']);
      DB::table('sizes')->insert(['name' => 'medium']);
      DB::table('sizes')->insert(['name' => 'large']);
    }
}
