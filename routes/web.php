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
// Route::delete('products/{product}/images', 'Product\ProductImageController@destroy')
//     ->name('products.images.destroy');
Route::resource('products.images', 'Product\ProductImageController');

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

/**
 * Order
 */
Route::resource('orders', 'Order\OrderController');

/**
 * Payment Collected
 */
Route::post('payment-collected', 'Payment\PaymentCollectedController');

/**
 * Invoice
 */
Route::get('invoice/{order}', 'Invoice\InvoiceController')
    ->name('invoices.pdf');

/**
 * User Order
 */
Route::get('users/{user}/orders/list',  'User\UserOrderAjaxController@index')
    ->name('users.orders.list');
Route::middleware('auth')->resource('users.orders', 'User\UserOrderController');

/**
 * User Product Rating
 */
Route::get('users/{user}/products/ratings',  'User\UserProductRatingController@index')
    ->name('users.products.ratings.index');
Route::get('users/{user}/products/ratings/list',  'User\UserProductRatingAjaxController')
    ->name('users.products.ratings.list');
Route::put('users/{user}/products/{product}/ratings', 'User\UserProductRatingController@update')
    ->name('users.products.ratings.update');

/**
 * Coupon
 */
Route::get('coupons/destroy', 'Coupon\CouponController@destroy')
    ->name('coupons.destroy');
Route::resource('coupons', 'Coupon\CouponController')->except('destroy');

/**
 * Test
 */
Route::get('/test', 'TestController@index');
Route::get('mailable', function () {
    return new App\Mail\TestMail();
});