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

    	return redirect()->back();
    }

    public function topping(){
      $order = Session::get('order');
    	$toppings = Topping::all();

      for($i = 0; $i < count($order->getPizzas()); $i++){
        if(!$order->getPizzas()[$i]['complete']){
          $pizza = $order->getPizzas()[$i];
          break;
        }
      }

    	return view('order.toppings', compact('toppings', 'pizza', 'order'));
    }

    public function saveTopping($id, $size){
      $topping = Topping::find($id);
      $size = Size::find($size);
      $order = Session::get('order');

      foreach($topping->sizes as $toppingSize){
        if($toppingSize->name == $size->name){
          $order->addTopping($topping, $size, $toppingSize->pivot->price);
          $order->setTotal($toppingSize->pivot->price);
        }
      }

    	return redirect()->back();
    }

    public function delivery(){
      $order = Session::get('order');

      foreach($order->getPizzas() as $savedPizza){
        if(!$savedPizza['complete']){
          $order->completePizza($savedPizza);
          $order->updateSession();

          return redirect()->back();
        }
      }

    	return view('order.delivery', compact('order'));
    }
}
