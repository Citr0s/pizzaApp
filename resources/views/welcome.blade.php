@extends('layouts.master')
<?php use App\Basket; ?>
@section('content')
    <div class="page-header">
        <h1>Welcome</h1>
    </div>
    <div class="row">
      <div class="col-md-8">
      @if(Auth::guest())
          <a href="/login"><button type="button" class="btn btn-default">Login</button></a>
          <a href="/register"><button type="button" class="btn btn-primary">Register</button></a>
      @else
          <a href="/logout"><button type="button" class="btn btn-default">Logout</button></a>
      @endif
      <a href="/order"><button type="button" class="btn btn-success">Order</button></a>
    </div>
    @if(!Auth::guest() && !is_null($order))
      <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
              Order Overview
              <span class="pull-right">
                <a href="/order/confirm"><button type="button" class="label label-success">Finish Order</button></a>
              </span>
            </div>
            <div class="panel-body">
                <table class="table">
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
                </table>
            </div>
          </div>
			</div>
    @endif
  </div>
@endsection
