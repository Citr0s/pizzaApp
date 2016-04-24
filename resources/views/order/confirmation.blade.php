@extends('layouts.master')

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
          @include('partials.overview')
  			</div>
      @endif
		</div>
@endsection
