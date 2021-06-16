<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
    return view('welcome');
});

Route::get('/allproducts','ProductsController@allproducts')->name('products.all');
Route::get('/single/product/{id}','ProductsController@single');
Route::post('/product/payment','PaymentController@payment')->name('payment.process');

Route::post('/stripe/charge','PaymentController@StripeCharge')->name('stripe');
Route::get('/payment/confirmation','PaymentController@confirmation')->name('payment.confirmation');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::get('product/remove/{id}','ProductsController@modal');
Route::delete('product/delete','ProductsController@delete')->name('product.remove');
Route::get('product/checkout/{id}','ProductsController@checkout');
Route::resource('/product','ProductsController');

