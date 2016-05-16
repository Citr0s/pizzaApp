<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Pizza;
use App\Topping;
use App\Size;
use App\Basket;
use App\Http\Controllers\OrderController;

class BasketTest extends TestCase
{
  private $order;

  public function setUp(){
    parent::setUp();
    $this->order = new Basket();
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

  public function test_adding_topping_to_pizza(){
      $pizza = Pizza::find(1);
      $size = Size::find(1);
      $price = 800;
      $this->order->addPizza($pizza, $size, $price);

      $topping = Topping::find(1);
      $size = Size::find(1);
      $price = 100;
      $this->order->addTopping($topping, $size, $price);

      $this->assertEquals('Cheese', $this->order->getPizzas()[0]['toppings'][0]['topping']->name);
  }

  public function test_marking_pizza_as_complete(){
      $pizza = Pizza::find(1);
      $size = Size::find(1);
      $price = 800;
      $this->order->addPizza($pizza, $size, $price);

      $pizza = [
        'pizza' => $pizza,
        'size' => $size,
        'price' => $price,
        'complete' => false,
        'toppings' => []
      ];

      $this->order->completePizza($pizza);

      $this->assertTrue($this->order->getPizzas()[0]['complete']);
  }

  public function test_setting_delivery_type(){
    $this->order->setDeliveryType('collection');

    $this->assertEquals('collection', $this->order->getDeliveryType());
  }

  public function test_completing_an_order(){
    $this->order->setComplete();

    $this->assertTrue($this->order->getComplete());
  }

  public function test_setting_total_of_order(){
    $this->order->setTotal(1000);

    $this->assertEquals('10', $this->order->getTotal());
  }

  public function test_getting_price_formatted_in_pounds(){
    $actual = Basket::getPriceInPounds(1000);

    $this->assertEquals(10, $actual);
  }

  public function test_generating_json(){
    $pizza = Pizza::find(1);
    $size = Size::find(1);
    $price = 800;
    $this->order->addPizza($pizza, $size, $price);

    $topping = Topping::find(1);
    $size = Size::find(1);
    $price = 100;
    $this->order->addTopping($topping, $size, $price);

    $this->order->setDeliveryType('delivery');
    $actual = $this->order->getJson();
    $expected = '{"pizzas":[{"pizza":{"id":1,"name":"Original Pizza"},"size":{"id":1,"name":"small"},"price":800,"complete":false,"toppings":[{"topping":{"id":1,"name":"Cheese"},"size":{"id":1,"name":"small"},"price":100}]}],"deliveryType":"delivery","complete":false,"total":0}';

    $this->assertEquals($expected, $actual);
  }

  public function test_trying_to_save_bad_pizza(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->savePizza(9999, 1);
  }

  public function test_trying_to_save_bad_size_size(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->savePizza(1, 9999);
  }

  public function test_trying_to_save_bad_pizza_and_size(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->savePizza(9999, 9999);
  }

  public function test_trying_to_save_bad_topping(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->saveTopping(9999, 1);
  }

  public function test_trying_to_save_bad_topping_size(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->saveTopping(1, 9999);
  }

  public function test_trying_to_save_bad_topping_and_size(){
    $this->setExpectedException('Exception');
    $orderController = new OrderController();
    $orderController->saveTopping(9999, 9999);
  }
}
