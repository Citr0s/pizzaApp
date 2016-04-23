<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\Topping;
use App\Pizza;
use Session;

class OrderController extends Controller
{
    public function pizza(){
      $order = new Order();
      $total = $order->getTotal();
  	  $pizzas = Pizza::all();

    	return view('order.index', compact('pizzas', 'total', 'order'));
    }

    public function topping(){
      $order = Session::get('order');
      $total = $order->total;
    	$toppings = Topping::all();

      foreach($order->pizzas as $savedPizza){
        if(!$savedPizza->complete){
          $pizza = $savedPizza;
        }
      }

    	return view('order.toppings', compact('toppings', 'pizza', 'total', 'order'));
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

    public function savePizza($id, $size){
      $pizza = Pizza::find($id);
      Order::addPizza($pizza, $size);

    	return redirect()->back();
    }

    public function saveTopping($id, $size){
      $topping = Topping::find($id);
      Order::addTopping($topping, $size);

    	return redirect()->back();
    }
}
