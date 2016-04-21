<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pizza;

class PizzaTest extends TestCase
{
  public function test_getting_all_pizzas(){
      $this->assertTrue(true);
  }

  public function test_getting_price_formatted_in_pounds(){
    $actual = Pizza::getPriceInPounds(1000);

    $this->assertEquals(10, $actual);

  }
}
