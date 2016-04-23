<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
  public function sizes(){
    return $this->belongsToMany('App\Size', 'topping_prices')->withPivot('price');
  }

  public static function getPriceInPounds($price){
    return number_format($price / 100, 2);
  }
}
