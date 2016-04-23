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
        'complete' => false,
        'toppings' => []
      ];
      array_push($this->pizzas, $savablePizzaArray);
      $this->updateSession();
    }

    public function addTopping(Topping $topping, Size $size, $price){
      $savableToppingArray = [
        'topping' => $topping,
        'size' => $size,
        'price' => $price
      ];

      for($i = 0; $i < count($this->pizzas); $i++){
        if(!$this->pizzas[$i]['complete']){
          array_push($this->pizzas[$i]['toppings'], $savableToppingArray);
          break;
        }
      }

      $this->updateSession();
    }

    public function getPizzas(){
      return $this->pizzas;
    }

    public function getToppings($pizzaToppings){
      $toppings = [];

      foreach($pizzaToppings as $topping){
        array_push($toppings, $topping['topping']);
      }

      return $toppings;
    }

    public function completePizza($pizza){
      for($i = 0; $i < count($this->pizzas); $i++){
        if(!$this->pizzas[$i]['complete']){
          if($this->pizzas[$i] === $pizza){
            $this->pizzas[$i]['complete'] = true;
            break;
          }
        }
      }
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
