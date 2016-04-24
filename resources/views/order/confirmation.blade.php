@extends('layouts.master')
<?php use App\Basket; ?>
@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Complete</small>
        </h1>
    </div>
		<div class="row">
			<div class="col-md-8">
        @if(!$order->complete)
        <div class="panel panel-default">
            <div class="panel-heading">Confirm</div>
            <div class="panel-body">
              <form action="/order/confirm" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label><input type="radio" name="confirm" value="kitchen"> Send to Kitchen</label>
                </div>
                <div class="form-group">
                  <label><input type="radio" name="confirm" value="later"> Save for Later</label>
                </div>
                <button type="submit" class="btn btn-default">Confirm</button>
              </form>
            </div>
          </div>
        @else
          <p>Thank you for your order!</p>
        @endif
      </div>
      @if(!Auth::guest() && !is_null($order))
        <div class="col-md-4">
          <div class="panel panel-default">
              <div class="panel-heading">Order Overview</div>
              <div class="panel-body">
                  <table class="table">
                    @if(is_null($order->pizzas))
                      <?php
                        if(is_null($order['pizzas'])){
                          $order = $order->getPizzas();
                        }else{
                          $order = $order['pizzas'];
                        }
                      ?>
                      @foreach($order as $pizzaInfo)
          							<tr>
          								<td>{{ $pizzaInfo['pizza']->name }}</td>
          								<td>{{ $pizzaInfo['size']->name }}</td>
          								<td>£{{ Basket::getPriceInPounds($pizzaInfo['price']) }}</td>
          							</tr>
                        @if(count($pizzaInfo['toppings']) > 0)
                          <tr>
                            <td>
                              Toppings:
                            </td>
                            <td>
                                <?php $totalToppingPrice = 0;?>
                                @foreach($pizzaInfo['toppings'] as $topping)
                                    {{ $topping['topping']->name }}<br />
                                    <?php $totalToppingPrice += $topping['price'] ?>
                                @endforeach
                            </td>
                            <td>
                              £{{ number_format($totalToppingPrice / 100, 2) }}
                            <td>
                          </tr>
                        @endif
          						@endforeach
                    @else
                      @foreach($order->pizzas as $pizzaInfo)
          							<tr>
          								<td>{{ $pizzaInfo->pizza->name }}</td>
          								<td>{{ $pizzaInfo->size->name }}</td>
          								<td>£{{ Basket::getPriceInPounds($pizzaInfo->price) }}</td>
          							</tr>
                        @if(count($pizzaInfo->toppings) > 0)
                          <tr>
                            <td>
                              Toppings:
                            </td>
                            <td>
                                <?php $totalToppingPrice = 0;?>
                                @foreach($pizzaInfo->toppings as $topping)
                                    {{ $topping->topping->name }}<br />
                                    <?php $totalToppingPrice += $topping->price ?>
                                @endforeach
                            </td>
                            <td>
                              £{{ number_format($totalToppingPrice / 100, 2) }}
                            <td>
                          </tr>
                        @endif
          						@endforeach
                    @endif
                  </table>
              </div>
            </div>
  			</div>
      @endif
		</div>
@endsection
