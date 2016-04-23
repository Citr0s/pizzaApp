<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Topping;

class ToppingTest extends TestCase
{
  public function test_getting_price_formatted_in_pounds(){
    $actual = Topping::getPriceInPounds(1000);
    $this->assertEquals(10, $actual);
  }
}
