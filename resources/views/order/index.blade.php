@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Pizza</small>
        	<span class="pull-right">
        		<small>Running Total</small> £{{ $order->getTotal() }}
        	</span>
        </h1>
    </div>
    	<div class="row">
    		<div class="col-md-12" style="margin-bottom:15px;">
    			<span class="pull-left">
	    			<a href="/"><button type="button" class="btn btn-default">Home</button></a>
	    		</span>
	    		<span class="pull-right">
	    			<a href="/order/topping"><button type="button" class="btn btn-default">Next</button></a>
	    		</span>
    		</div>
    	</div>
		<div class="row">
			<div class="col-md-8">
			@foreach($pizzas as $pizza)
				<div class="col-md-4 pizza">
					<div class="panel panel-default">
						<div class="panel-heading">{{ $pizza->name }}</div>
						<div class="panel-body">
							<p>
								{{ $pizza->getToppings() }}
							</p>
							<table class="table">
                  @foreach($pizza->sizes as $size)
                    <tr>
    									<td>{{ ucfirst($size->name) }}</td>
    									<td>£{{ $pizza->getPriceInPounds($size->pivot->price) }}</td>
    									<td><a href="/order/pizza/add/{{ $pizza->id }}/{{ $size->id }}"><span class="label label-primary">Select</span></a></td>
    								</tr>
                  @endforeach
							</table>
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
							<tr>
								<td>{{ $pizzaInfo['pizza']->name }}</td>
								<td>{{ $pizzaInfo['size']->name }}</td>
								<td>£{{ $order::getPriceInPounds($pizzaInfo['price']) }}</td>
							</tr>
						@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
@endsection
