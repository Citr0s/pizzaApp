@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Toppings</small>
        	<span class="pull-right">
        		<small>Running Total</small> £{{ number_format($total / 100, 2) }}
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
                  @foreach($topping->types as $type)
                    @if($type->size->name == $pizza->size)
                      £{{ $topping->getPriceInPounds($type->price) }}
                      @if(!in_array($topping->name, $pizza->toppings) || $pizza->name == 'Create Your Own')
		                   <a href="/order/topping/add/{{ $topping->id }}/{{ $type->size->name }}"><span class="label label-primary">Select</span></a>
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
                @foreach($order->pizzas as $orderPizza)
    							<tr @if($orderPizza->name == $pizza->name) style="background-color:#2cc36b;" @endif>
    								<td>{{ $orderPizza->name }}</td>
    								<td>{{ $orderPizza->size }}</td>
    								<td>£{{ number_format($pizza->price / 100, 2) }}</td>
    							</tr>
                  @if(count($orderPizza->toppings) > 0)
                    <tr>
                      <td>
                        Toppings:
                      </td>
                      <td>
                          <?php $totalToppingPrice = 0;?>
                          @foreach($orderPizza->toppings as $topping)
                              {{ $topping->name }}<br />
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
		</div>
@endsection
