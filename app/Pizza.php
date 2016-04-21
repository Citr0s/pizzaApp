<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
  public function getToppings(){
    $toppings = [];
    foreach($this->toppings as $topping){
      array_push($toppings, $topping->name);
    }
    return implode(', ', $toppings);
  }
  public function toppings(){
    return $this->belongsToMany('App\Topping', 'pizza_toppings');
  }

  public function types(){
    return $this->hasMany('App\Price');
  }

  public static function getPriceInPounds($price){
    return number_format($price / 100, 2);
  }
}
