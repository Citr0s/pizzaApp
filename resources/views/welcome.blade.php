@extends('layouts.master')

@section('content')
    <div class="page-header">
        <h1>Welcome</h1>
    </div>
  <div class="row">
    <div class="col-md-12">
      @if(Auth::guest())
          <a href="/login"><button type="button" class="btn btn-default">Login</button></a>
          <a href="/register"><button type="button" class="btn btn-primary">Register</button></a>
      @else
          <a href="/logout"><button type="button" class="btn btn-default">Logout</button></a>
      @endif
      <a href="/order"><button type="button" class="btn btn-success">Order</button></a>
    </div>
@endsection
