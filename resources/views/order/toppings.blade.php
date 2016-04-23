@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Toppings</small>
        	<span class="pull-right">
        		<small>Running Total</small> £{{ $order->getTotal() }}
        	</span>
        </h1>
    </div>
    	<div class="row">
    		<div class="col-md-12" style="margin-bottom:15px;">
    			<span class="pull-left" style="margin-right:15px;">
    				<a href="/order/pizza"><button type="button" class="btn btn-default">Back</button></a>
    			</span>
    			<span class="pull-right">
    				<a href="/order/delivery"><button type="button" class="btn btn-default">Next</button></a>
    			</span>
    		</div>
    	</div>
		<div class="row">
      <div class="col-md-8">
    		@foreach($toppings as $topping)
    			<div class="col-md-4 ingredient">
    				<div class="panel panel-default">
    					<div class="panel-body">
    						{{ $topping->name }}
    						<span class="pull-right">
                  @foreach($topping->sizes as $size)
                    <?php
                      $isInArray = false;
                      foreach($pizza['toppings'] as $currentTopping){
                        if($currentTopping['topping']->name === $topping->name){
                          $isInArray = true;
                        }
                      }
                    ?>
                    @if($size->name == $pizza['size']->name)
                      £{{ $topping->getPriceInPounds($size->pivot->price) }}
                      @if(!$isInArray || $pizza['pizza']->name == 'Create Your Own')
		                   <a href="/order/topping/add/{{ $topping->id }}/{{ $size->id }}"><span class="label label-primary">Select</span></a>
                      @endif
                    @endif
                  @endforeach
    						</span>
    					</div>
    				</div>
    			</div>
  		  @endforeach
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">Order Overview</div>
            <div class="panel-body">
              <table class="table">
                @foreach($order->getPizzas() as $pizzaInfo)
    							<tr @if($pizzaInfo['pizza'] === $pizza['pizza']) style="background-color:#2cc36b;" @endif>
    								<td>{{ $pizzaInfo['pizza']->name }}</td>
    								<td>{{ $pizzaInfo['size']->name }}</td>
    								<td>£{{ $order::getPriceInPounds($pizzaInfo['price']) }}</td>
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
              </table>
            </div>
          </div>
      </div>
		</div>
@endsection
