<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PizzaPrice extends Model
{
  public $table = 'pizza_prices';

  public function size(){
    return $this->hasOne('App\Size', 'id', 'size_id');
  }
}
