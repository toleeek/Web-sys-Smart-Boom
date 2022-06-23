<?php

use Illuminate\Support\Facades\Route;


Route::get('/', 'IndexController')->name('index');


Route::get('/page/{page:slug}', 'PageController')->name('page.show');


Route::group([
    'as' => 'catalog.',
    'prefix' => 'catalog',
], function () {

    Route::get('index', 'CatalogController@index')
        ->name('index');

    Route::get('category/{category:slug}', 'CatalogController@category')
        ->name('category');

    Route::get('brand/{brand:slug}', 'CatalogController@brand')
        ->name('brand');

    Route::get('product/{product:slug}', 'CatalogController@product')
        ->name('product');

    Route::get('search', 'CatalogController@search')
        ->name('search');
});


Route::group([
    'as' => 'basket.',
    'prefix' => 'basket',
], function () {

    Route::get('index', 'BasketController@index')
        ->name('index');

    Route::get('checkout', 'BasketController@checkout')
        ->name('checkout');

    Route::post('profile', 'BasketController@profile')
        ->name('profile');

    Route::post('saveorder', 'BasketController@saveOrder')
        ->name('saveorder');

    Route::get('success', 'BasketController@success')
        ->name('success');

    Route::post('add/{id}', 'BasketController@add')
        ->where('id', '[0-9]+')
        ->name('add');

    Route::post('plus/{id}', 'BasketController@plus')
        ->where('id', '[0-9]+')
        ->name('plus');

    Route::post('minus/{id}', 'BasketController@minus')
        ->where('id', '[0-9]+')
        ->name('minus');

    Route::post('remove/{id}', 'BasketController@remove')
        ->where('id', '[0-9]+')
        ->name('remove');

    Route::post('clear', 'BasketController@clear')
        ->name('clear');
});


Route::name('user.')->prefix('user')->group(function () {
    Auth::routes();
});


Route::group([
    'as' => 'user.',
    'prefix' => 'user',
    'middleware' => ['auth']
], function () {

    Route::get('index', 'UserController@index')->name('index');

    Route::resource('profile', 'ProfileController');

    Route::get('order', 'OrderController@index')->name('order.index');

    Route::get('order/{order}', 'OrderController@show')->name('order.show');
});


Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin']
], function () {

    Route::get('index', 'IndexController')->name('index');

    Route::resource('category', 'CategoryController');

    Route::resource('brand', 'BrandController');

    Route::resource('product', 'ProductController');

    Route::get('product/category/{category}', 'ProductController@category')
        ->name('product.category');

    Route::resource('order', 'OrderController', ['except' => [
        'create', 'store', 'destroy'
    ]]);

    Route::resource('user', 'UserController', ['except' => [
        'create', 'store', 'show', 'destroy'
    ]]);

    Route::resource('page', 'PageController');

    Route::post('page/upload/image', 'PageController@uploadImage')
        ->name('page.upload.image');

    Route::delete('page/remove/image', 'PageController@removeImage')
        ->name('page.remove.image');
});
