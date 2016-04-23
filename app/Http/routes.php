<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
Route::get('/order', 'OrderController@pizza');
Route::get('/order/pizza', 'OrderController@pizza');
Route::get('/order/pizza/add/{id}/{size}', 'OrderController@savePizza');
Route::get('/order/topping', 'OrderController@topping');
Route::get('/order/topping/add/{id}/{size}', 'OrderController@saveTopping');
Route::get('/order/delivery', 'OrderController@delivery');
Route::get('/home', 'HomeController@index');

/** debug **/
Route::get('/reset', function(){
  Session::forget('order');
});
