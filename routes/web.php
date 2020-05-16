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
Route::middleware('auth')->get('users/{user}/ratings',
    'User\UserRatingController@index')
    ->name('users.ratings.index');
Route::middleware('auth')->get('users/{user}/ratings/list',
    'User\UserRatingAjaxController')
    ->name('users.ratings.list');
Route::middleware('auth')->put('users/{user}/products/{product}/ratings',
    'User\UserRatingController@update')
    ->name('users.ratings.update');

/**
 * User Product Favorite
 */
Route::middleware('auth')->get('users/{user}/favorites',
    'User\UserFavoriteController@index')
    ->name('users.favorites.index');
Route::middleware('auth')->get('users/{user}/favorites/list',
    'User\UserFavoriteAjaxController')
    ->name('users.favorites.list');
Route::middleware('auth')->put('users/{user}/products/{product}/favorites',
    'User\UserFavoriteController@update')
    ->name('users.favorites.update');

/**
 * User Shipping
 */
Route::middleware('auth')->put('users/{user}/shippings/{shipping?}',
    'User\UserShippingController@update')
    ->name('users.shippings.update');

Route::middleware('auth')->get('users/{user}/shippings',
    'User\UserShippingController@index')
    ->name('users.shippings.index');

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