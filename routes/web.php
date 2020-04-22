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
 * ProductImage
 */
Route::resource('products.images', 'Product\ProductImageController');

/**
 * ShoppingCart
 */
Route::get('shopping-cart/items', 'ShoppingCart\ShoppingCartController@index')
    ->middleware('cart.exists')
    ->name('shopping.cart.index');
Route::delete('shopping-cart/empty', 'ShoppingCart\ShoppingCartController@empty')
    ->name('shopping.cart.empty');
Route::post('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@store')
    ->name('shopping.cart.store');
Route::patch('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@update')
    ->name('shopping.cart.update');
Route::delete('shopping-cart/products/{product}', 'ShoppingCart\ShoppingCartController@destroy')
    ->name('shopping.cart.remove');

/**
 * Checkout
 */
Route::get('checkout', 'Checkout\CheckoutController@index')
    ->middleware('cart.exists')
    ->name('checkouts.index');
Route::post('checkout', 'Checkout\CheckoutController@store')
    ->middleware('cart.exists')
    ->name('checkouts.store');

/**
 * CheckoutSuccess
 */
Route::get('checkout/payment/success','Checkout\CheckoutSuccessController')
    ->name('checkouts.success');

/**
 * CheckoutError
 */
Route::get('checkout/payment/error','Checkout\CheckoutErrorController')
    ->name('checkouts.error');

Route::get('/test', 'TestController@index')->name('tests.index');
Route::post('/test', 'TestController@store')->name('tests.store');

/**
 * Product
 */
Route::resource('orders', 'Order\OrderController');
