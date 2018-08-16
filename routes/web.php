<?php
use Illuminate\Support\Facades\Route;

Auth::routes();

// Home
Route::get('/', 'HomeController@index');

// Product
Route::resource('product', 'ProductController');
Route::post('/filter-products', 'ProductController@getProducts');

// Brands
Route::get('get-restoraunts', 'RestorauntController@getRestoraunts');

// Cart
Route::post('/cart/store', 'CartController@store');
Route::get('/cart/products', 'CartController@getProducts');
Route::delete('/cart/products/{id}', 'CartController@destroy');
Route::get('/test', 'CartController@test');
Route::post('/cart/counter', 'CartController@counter');

// Logout
Route::get('/logout', function () {
   \Illuminate\Support\Facades\Auth::logout();
   session()->flush();
   return redirect('/');
});