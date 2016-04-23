<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ToppingPrice extends Model
{
  public $table = 'topping_prices';

  public function size(){
    return $this->hasOne('App\Size', 'id', 'size_id');
  }
}
