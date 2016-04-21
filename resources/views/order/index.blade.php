@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Pizza</small>
        	<span class="pull-right">
        		<small>Running Total</small> £{{ $total }}
        	</span>
        </h1>
    </div>
    	<div class="row">
    		<div class="col-md-12" style="margin-bottom:15px;">
    			<span class="pull-left">
	    			<a href="/"><button type="button" class="btn btn-default">Home</button></a>
	    		</span>
	    		<span class="pull-right">
	    			<a href="/order/ingredient"><button type="button" class="btn btn-default">Next</button></a>
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
                  @foreach($pizza->types as $type)
                    <tr>
    									<td>{{ ucfirst($type->size->name) }}</td>
    									<td>£{{ $pizza->getPriceInPounds($type->price) }}</td>
    									<td><a href="/order/pizza/add/{{ $pizza->id }}/{{ $type->size->name }}"><span class="label label-primary">Select</span></a></td>
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
						@foreach($order->getPizzas() as $pizza)
							<tr>
								<td>{{ $pizza->name }}</td>
								<td>{{ $pizza->size }}</td>
								<td>£{{ number_format($pizza->price / 100, 2) }}</td>
							</tr>
						@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
@endsection
