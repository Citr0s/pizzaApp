<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Order;
use App\Pizza;
use Session;

class OrderController extends Controller
{
    public function index(){
      $order = new Order();
      $total = $order->getTotal();
  	  $pizzas = Pizza::all();

    	return view('order.index', compact('pizzas', 'total', 'order'));
    }

    public function savePizza($id, $size){
      $pizza = Pizza::find($id);
      Order::addPizza($pizza, $size);

    	return redirect()->back();
    }
}
