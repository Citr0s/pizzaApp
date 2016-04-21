@extends('layout.master')
@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Ingredients</small>
        	<span class="pull-right">
        		<small>Running Total</small> £{{ $subTotal }}
        	</span>
        </h1>
    </div>
    	<div class="row">
    		<div class="col-md-12" style="margin-bottom:15px;">
    			<span class="pull-left" style="margin-right:15px;">
    				<a href="/order/pizza"><button type="button" class="btn btn-default">Back</button></a>
    			</span>
    			<span class="pull-right">
    				<a href="/order/ingredient/pizza/next"><button type="button" class="btn btn-default">Next</button></a>
    			</span>
    		</div>
    	</div>
		<div class="row">
            <div class="col-md-8">
    		@foreach($ingredients as $ingredient)
    			<div class="col-md-4 ingredient">
    				<div class="panel panel-default">
    					<div class="panel-body">
    						{{ $ingredient->name }}
    						<span class="pull-right">
    							£{{ $ingredient->getFormattedPrice() }}
                  @if(!in_array($ingredient, $currentPizza->getExtraIngredients()) ||$currentPizza->name == 'Create Your Own')
    							 <a href="/order/ingredient/add/{{ $ingredient->id }}"><span class="label label-primary">Select</span></a>
                  @endif
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
                        @foreach($order->get() as $pizza)
                            <tr @if($currentPizza->name == $pizza->name && $currentPizza->getSize() == $pizza->getSize()) class="success" @endif>
                                <td>{{ $pizza->name }}</td>
                                <td>{{ $pizza->getSize() }}</td>
                                <td>£{{ $pizza->getFormattedPrice($pizza->price) }}</td>
                            </tr>
                            <tr>
                                <td>Extra Ingredients:</td>
                                <td>
                                    @foreach($pizza->getExtraIngredients() as $ingredient)
                                        {{ $ingredient->name }}<br />
                                    @endforeach
                                </td>
                                <td>
                                  £{{ $pizza->getFormattedPrice(number_format($ingredient->getPrice() *  count($pizza->getExtraIngredients()), 2)) }}
                                </td>
                            </tr>
                        @endforeach
                        </table>
                    </div>
                </div>
            </div>
		</div>
@endsection
