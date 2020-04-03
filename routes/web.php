<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'Product\ProductController@index')->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * Product
 */
Route::resource('products', 'Product\ProductController')->except('index');