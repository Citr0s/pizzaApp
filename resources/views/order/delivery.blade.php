@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>
        	Order <small>Select Delivery</small>
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
    		</div>
    	</div>
		<div class="row">
      <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">Delivery Type</div>
            <div class="panel-body">
              <form action="/order/delivery/save" method="post">
                {!! csrf_field() !!}
                <div class="form-group">
                  <label><input type="radio" name="delivery" value="collection"> Collection</label>
                </div>
                <div class="form-group">
                  <label><input type="radio" name="delivery" value="delivery"> Delivery</label>
                </div>
                <button type="submit" class="btn btn-default">Next</button>
              </form>
            </div>
          </div>
      </div>
      <div class="col-md-4">
        @include('partials.overview')
      </div>
		</div>
@endsection
