<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Session;

class Order extends Model
{
    private $pizzas;
    private $deliveryType;
    private $complete;
    private $total;

    public function __construct(){
      $this->pizzas = [];
      $this->complete = false;
      $this->total = 0;
      $this->updateSession();
    }

    public function addPizza(Pizza $pizza, Size $size, $price){
      $savablePizzaArray = [
        'pizza' => $pizza,
        'size' => $size,
        'price' => $price,
        'complete' => false
      ];
      array_push($this->pizzas, $savablePizzaArray);
      $this->updateSession();
    }

    public function getPizzas(){
      return $this->pizzas;
    }

    public function addTopping(Pizza $pizza, Topping $topping){
      foreach($this->pizzas as $savedPizza){
        if($pizza == $savedPizza){
          array_push($savedPizza, $topping);
        }
      }
      $this->updateSession();
    }

    public function setDeliveryType($type){
      $this->deliveryType = $type;
    }

    public function sendToKitchen(){
      $this->complete = true;
    }

    public function setTotal($value){
      $this->total += $value;
    }

    public function getTotal(){
      return self::getPriceInPounds($this->total);
    }

    public function updateSession(){
      Session::set('order', $this);
    }

    public static function getPriceInPounds($price){
      return number_format($price / 100, 2);
    }
}
