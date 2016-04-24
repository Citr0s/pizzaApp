<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\Basket;
use App\Topping;
use App\Size;
use App\Pizza;
use Session;
use Auth;

class OrderController extends Controller
{
    public function index(){
        $order = Order::where('user_id', '=', Auth::id())->where('complete', '=', false)->first();

        if(!is_null($order)){
            $order = json_decode($order->data);
        }

        return view('welcome', compact('order'));
    }

    public function pizza(){
      if(!Session::has('order')){
        new Basket();
      }
      $order = Session::get('order');
  	  $pizzas = Pizza::all();

    	return view('order.index', compact('pizzas', 'order'));
    }

    public function savePizza($id, $size){
      if(!is_numeric($id) || !is_numeric($size)){
        return redirect('/');
      }

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

      if(is_null($order)){
        return redirect('/order/pizza');
      }

      for($i = 0; $i < count($order->getPizzas()); $i++){
        $pizza = $order->getPizzas()[$i];
        if(!$order->getPizzas()[$i]['complete']){
          $pizza = $order->getPizzas()[$i];
          break;
        }
      }

      if(!isset($pizza)){
        return redirect()->back();
      }


    	return view('order.toppings', compact('toppings', 'pizza', 'order'));
    }

    public function saveTopping($id, $size){
      if(!is_numeric($id) || !is_numeric($size)){
        return redirect('/');
      }

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
      $morePizzas = false;

      if(is_null($order)){
        return redirect('/order/topping');
      }

      foreach($order->getPizzas() as $savedPizza){
        if(!$savedPizza['complete']){
          $order->completePizza($savedPizza);
          $order->updateSession();
          break;
        }
      }

      foreach($order->getPizzas() as $savedPizza){
        if(!$savedPizza['complete']){
          $morePizzas = true;
        }
      }

      if($morePizzas){
        return redirect()->back();
      }

      $order->setComplete();
      $order->updateSession();

    	return view('order.delivery', compact('order'));
    }

    public function saveDelivery(Request $type){
        $order = Session::get('order');
        $order->setDeliveryType($type->delivery);
        $order->updateSession();

        return redirect('/order/confirm');
    }
}
