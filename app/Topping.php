<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
  public function types(){
    return $this->hasMany('App\ToppingPrice');
  }
  
  public static function getPriceInPounds($price){
    return number_format($price / 100, 2);
  }
}
