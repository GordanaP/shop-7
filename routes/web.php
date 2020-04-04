<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Product\ProductController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Product
 */
Route::resource('products', 'Product\ProductController')->except('index');

/**
 * ShoppingCart
 */
Route::get('shopping-cart/items', 'ShoppingCart\ShoppingCartController@index')
    ->name('shopping.cart.index');
Route::delete('shopping-cart/empty', 'ShoppingCart\ShoppingCartController@empty')
    ->name('shopping.cart.empty');
Route::post('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@store')
    ->name('shopping.cart.store');
Route::patch('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@update')
    ->name('shopping.cart.update');
Route::delete('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@destroy')
    ->name('shopping.cart.remove');
