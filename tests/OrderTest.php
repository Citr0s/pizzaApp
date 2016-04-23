<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pizza;
use App\Size;
use App\Order;

class OrderTest extends TestCase
{
    private $order;

    public function setUp(){
      parent::setUp();

      $this->order = new Order();
    }
    public function test_if_session_is_being_set_when_creating_new_order(){
        $this->assertTrue(Session::has('order'));
    }

    public function test_if_total_is_being_set_when_creating_new_order(){
        $this->assertEquals(0, $this->order->getTotal());
    }

    public function test_adding_pizza_to_order(){
        $pizza = Pizza::find(1);
        $size = Size::find(1);
        $price = 800;

        $this->order->addPizza($pizza, $size, $price);

        $this->assertEquals('Original Pizza', $this->order->getPizzas()[0]['pizza']->name);
    }

    public function test_getting_price_formatted_in_pounds(){
      $actual = Order::getPriceInPounds(1000);

      $this->assertEquals(10, $actual);
    }
}
