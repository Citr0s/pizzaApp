<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Order;
use Auth;

class ConfirmationController extends Controller
{
  public function __construct(){
	    $this->middleware('auth');
	}

  public function index(){
    $order = Session::get('order');

    if(!isset($order) || empty($order->getPizzas())){
      $order = Order::where('user_id', '=', Auth::id())->where('complete', '=', false)->first();

      if(!is_null($order)){
          $order = json_decode($order->data);
          $order->complete = false;
      }

      if(is_null($order)){
        $order = Order::where('user_id', '=', Auth::id())->first();
        $order->complete = true;
        $order = json_decode($order->data);
      }
    }

    if(!is_null($order) && method_exists($order, 'getComplete')){
      if($order->getComplete()){
        $tempOrder = new Order();
        $tempOrder->user_id = Auth::id();
        $tempOrder->data = $order->getJson();
        $tempOrder->delivery = $order->getDeliveryType();
        $tempOrder->save();
        Session::forget('order');
      }
    }

    return view('order/confirmation', compact('order'));
  }

  public function confirm(Request $request){
    if($request->confirm == 'kitchen'){
      $order = Order::where('user_id', '=', Auth::id())->where('complete', '=', false)->first();
      $order->complete = true;
      $order->save();
      return redirect('/order/confirm');
    }else{
      $order = Order::where('user_id', '=', Auth::id())->where('complete', '=', false)->first();
      $order->complete = false;
      $order->save();
      return redirect('/');
    }
  }
}
