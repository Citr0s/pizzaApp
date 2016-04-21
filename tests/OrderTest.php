<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pizza;
use App\Order;
use Session;

class OrderTest extends TestCase
{
    public function test_if_session_is_being_set_when_creating_new_order(){
        $order = new Order();
        $this->assertTrue(Session::has('order'));
    }

    public function test_if_total_is_being_set_when_creating_new_order(){
        $order = new Order();
        $this->assertEquals(0, $order->getTotal());
    }

    public function test_adding_pizza_to_order(){
        $pizza = new \stdClass;
        $pizza->name = 'Test Pizza';
        $pizza->size = 'large';
        $pizza->types = new \stdClass;
        $pizza->types->type = new \stdClass;
        $pizza->types->type->size = new \stdClass;
        $pizza->types->type->size->name = 'large';
        $pizza->types->type->price = 1000;

        $order = new Order();
        $order->addPizza($pizza, 'large');

        $this->assertEquals('Test Pizza', $order->getPizzas()[0]->name);
    }

    public function test_getting_price_formatted_in_pounds(){
      $actual = Pizza::getPriceInPounds(1000);

      $this->assertEquals(10, $actual);
    }
}
