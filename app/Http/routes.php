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

Route::auth();
Route::get('/', 'OrderController@index');
Route::get('/order', 'OrderController@pizza');
Route::get('/order/pizza', 'OrderController@pizza');
Route::get('/order/pizza/add/{id}/{size}', 'OrderController@savePizza');
Route::get('/order/topping', 'OrderController@topping');
Route::get('/order/topping/add/{id}/{size}', 'OrderController@saveTopping');
Route::get('/order/delivery', 'OrderController@delivery');
Route::get('/home', 'HomeController@index');
Route::post('/order/delivery/save', 'OrderController@saveDelivery');
Route::get('/order/confirm', 'ConfirmationController@index');
Route::post('/order/confirm', 'ConfirmationController@confirm');

/** debug **/
Route::get('/reset', function(){
  Session::forget('order');
});
Route::get('/test', function(){
  dd(App\Pizza::find(1));
});
Route::get('/{page}', function(){
  return redirect('/');
});
