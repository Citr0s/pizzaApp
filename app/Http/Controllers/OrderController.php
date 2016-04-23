<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\Topping;
use App\Size;
use App\Pizza;
use Session;

class OrderController extends Controller
{
    public function pizza(){
      if(!Session::has('order')){
        new Order();
      }
      $order = Session::get('order');
  	  $pizzas = Pizza::all();

    	return view('order.index', compact('pizzas', 'order'));
    }

    public function savePizza($id, $size){
      $pizza = Pizza::find($id);
      $size = Size::find($size);
      $order = Session::get('order');

      foreach($pizza->sizes as $pizzaSize){
        if($pizzaSize->name == $size->name){
          $order->addPizza($pizza, $size, $pizzaSize->pivot->price);
          $order->setTotal($pizzaSize->pivot->price);
        }
      }

      $order->updateSession();
    	return redirect()->back();
    }

    public function topping(){
      $order = Session::get('order');
    	$toppings = Topping::all();

      foreach($order->getPizzas() as $savedPizza){
        if(!$savedPizza['complete']){
          $pizza = $savedPizza;
        }
      }

    	return view('order.toppings', compact('toppings', 'pizza', 'order'));
    }

    public function delivery(){
      $order = Session::get('order');

      foreach($order->pizzas as $savedPizza){
        if(!$savedPizza->complete){
          $savedPizza->complete = true;
          Order::saveToSession($order);
          return redirect('/order/topping');
        }
      }

      $total = $order->total;
    	return view('order.delivery', compact('total', 'order'));
    }

    public function saveTopping($id, $size){
      $topping = Topping::find($id);
      Order::addTopping($topping, $size);

    	return redirect()->back();
    }
}
